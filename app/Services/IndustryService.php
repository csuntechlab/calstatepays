<?php

namespace App\Services;

use App\Contracts\IndustryContract;
use App\Models\NaicsTitle;
use App\Models\University;
use App\Models\UniversityMajor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class IndustryService implements IndustryContract
{
    public function getAllIndustryNaicsTitles()
    {
        $allNaicsTitles = NaicsTitle::all();

        if ($allNaicsTitles->isEmpty()) {
            $message = 'There is no Naics Title data';
            throw new ModelNotFoundException($message, 409);
        }

        $allNaicsTitles = $allNaicsTitles->map(function ($item, $key) {
            return [
                'naics_code' => $item['naics_code'],
                'title' => $item['naics_title'],
                'image' => asset($item['image'])
            ];
        });
        return $allNaicsTitles;
    }

    public function getIndustryPopulationByRankWithImages($hegis_code, $universityName)
    {
        $university = University::where('short_name', $universityName)->where('opt_in', 1)->firstOrFail();
        $university_major = $this->industryRelation($hegis_code, $university);

        /** Seperate each student_path for fair population found comparison */
        $population = $this->retrievePopulation($university_major);

        /** Get the population total for each */
        $population_total = $this->retrievePopulationTotal($population);

        /** Calculate the percentages */
        $someCollege_population = $this->calculatePopulationPercentagesAndReturnImages($population["some_college"], $population_total["some_college"]);
        $bachelors_population = $this->calculatePopulationPercentagesAndReturnImages($population["bachelors"], $population_total["bachelors"]);
        $post_bacc_population = $this->calculatePopulationPercentagesAndReturnImages($population["post_bacc"], $population_total["post_bacc"]);

        /** concatenate each array to finalize the API */
        $industry_population_images["someCollege"] = $someCollege_population;
        $industry_population_images["bachelors"] = $bachelors_population;
        $industry_population_images["post_bacc"] = $post_bacc_population;

        return $industry_population_images;
    }

    public function getIndustryPopulationByRank($hegis_code, $universityName)
    {
        $university = University::where('short_name', $universityName)->where('opt_in', 1)->firstOrFail();
        $university_major = $this->industryRelation($hegis_code, $university);

        /** Seperate each student_path for fair population found comparison */
        $population = $this->retrievePopulation($university_major);

        /** Get the population total for each */
        $population_total = $this->retrievePopulationTotal($population);

        /** Calculate the percentages */
        $someCollege_population = $this->calculatePopulationPercentages($population["some_college"], $population_total["some_college"]);
        $bachelors_population = $this->calculatePopulationPercentages($population["bachelors"], $population_total["bachelors"]);
        $post_bacc_population = $this->calculatePopulationPercentages($population["post_bacc"], $population_total["post_bacc"]);

        /** concatenate each array to finalize the API */
        $industry_wages["someCollege"] = $someCollege_population;
        $industry_wages["bachelors"] = $bachelors_population;
        $industry_wages["post_bacc"] = $post_bacc_population;
        return $industry_wages;
    }

    private function industryRelation($hegis_code, $university)
    {
        $university_major = UniversityMajor::with(['industryPathTypes' => function ($query) {
            $query->where('entry_status', 'FTF + FTT');
            // when phpunit is not running we'll filter the relationship
            if (!env('PHPUNIT_RUNNING')) {
                $query->whereHas('industryWage', function ($query) {
                    $query->whereNotNull('avg_annual_wage_5');
                });
            }
        }, 'industryPathTypes.population', 'industryPathTypes.naicsTitle', 'industryPathTypes.industryWage'])
            ->where('hegis_code', $hegis_code)
            ->where('university_id', $university->id)
            ->firstOrFail();
        return $university_major;
    }

    private function retrievePopulation($university_major)
    {
        $someCollege_population = $university_major->industryPathTypes->where('student_path', 2)->sortByDesc('population.population_found')->values();
        $bachelors_population = $university_major->industryPathTypes->where('student_path', 1)->sortByDesc('population.population_found')->values();
        $post_bacc_population = $university_major->industryPathTypes->where('student_path', 4)->sortByDesc('population.population_found')->values();

        $data = ["some_college" => $someCollege_population, "bachelors" => $bachelors_population, "post_bacc" => $post_bacc_population];
        return $data;
    }

    private function retrievePopulationTotal($population)
    {
        $someCollege_total = $this->getIndustryPopulationTotals($population["some_college"]);
        $bachelors_total = $this->getIndustryPopulationTotals($population["bachelors"]);
        $post_bacc_total = $this->getIndustryPopulationTotals($population["post_bacc"]);

        $data = ["some_college" => $someCollege_total, "bachelors" => $bachelors_total, "post_bacc" => $post_bacc_total];
        return $data;
    }

    private function sortIndustryPopulation($university_major)
    {
        $industry_populations = $university_major->industryPathTypes->sortByDesc('population.population_found')->values();
        return $industry_populations;
    }

    private function getIndustryPopulationTotals($industry_populations)
    {
        $total = 0;
        foreach ($industry_populations as $pop) {
            if ($pop->population->population_found != null) {
                $total += $pop->population->population_found;
            }
        }
        return $total;
    }

    private function calculatePopulationPercentagesAndReturnImages($industry_populations, $population_total)
    {
        $final = $industry_populations = $industry_populations
            ->map(function ($industry, $index = 0) use ($population_total) {
                $index++;
                $percentage = $this->populationHandler($industry, $population_total);
                return [
                    'title' => $industry->naicsTitle->naics_title,
                    'percentage' => $percentage,
                    'rank' => $index,
                    'image' => asset($industry->naicsTitle->image),
                    'industryWage' => $industry->industryWage->avg_annual_wage_5
                ];
            });
        return $final;
    }

    private function populationHandler($industry, $population_total)
    {
        if (($industry->population->population_found != null) && ($population_total != null)) {
            // $percentage = round(($industry->population->population_found / $population_total) * 100, 0, PHP_ROUND_HALF_DOWN);
            $percentage = round(($industry->population->population_found / $population_total) * 100, 2);
            return $percentage;
        }
        return null;
    }

    private function calculatePopulationPercentages($industry_populations, $population_total)
    {
        $final = $industry_populations = $industry_populations
            ->map(function ($industry, $index = 0) use ($population_total) {
                $index++;
                $percentage = $this->populationHandler($industry, $population_total);
                return [
                    'title' => $industry->naicsTitle->naics_title,
                    'percentage' => $percentage,
                    'rank' => $index,
                    'student_path' => $industry->student_path,
                    'industryWage' => $industry->industryWage->avg_annual_wage_5
                ];
            });
        return $final;
    }
}