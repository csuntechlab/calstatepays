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
        $opt_in = University::where('short_name', $universityName)->where('opt_in', 1)->firstOrFail();

        $university_major = UniversityMajor::with(['industryPathTypes' => function ($query) {
            $query->where('entry_status', 'FTF + FTT');
            $query->where('student_path', $degree);
        }, 'industryPathTypes.population', 'industryPathTypes.naicsTitle', 'industryPathTypes.industryWage'])
            ->where('hegis_code', $hegis_code)
            ->where('university_id', $opt_in->id)
            ->firstOrFail();

        $industry_populations = $this->sortIndustryPopulation($university_major);

        $population_total = $this->getIndustryPopulationTotals($industry_populations);

        $industry_populations = $this->calculatePopulationPercentagesAndReturnImages($industry_populations, $population_total);

        return $industry_populations;
    }

    public function getIndustryPopulationByRank($hegis_code, $universityName)
    {
        // $degree = 1;
        $opt_in = University::where('short_name', $universityName)->where('opt_in', 1)->firstOrFail();
        
        /** no longer using degree level, must extract degree 1,2,4 for equal population total */
        $university_major = UniversityMajor::with(['industryPathTypes' => function ($query) {
            $query->where('entry_status', 'FTF + FTT');
            // $query->where('student_path', $degree);
        }, 'industryPathTypes.population', 'industryPathTypes.industryWage'])
            ->where('hegis_code', $hegis_code)
            ->where('university_id', $opt_in->id)
            ->firstOrFail();
            // dd($university_major);
        
        foreach ($university_major->industry_path_type as $key=>$data) {
            if ($data['student_path'] == 2) {
                $someCollege[$key] = $data;
            } else if ($data['student_path'] == 1) {
                $bachelors[$key] = $data;
            } else if ($data['student_path'] == 4) {
                $post_bacc[$key] = $data;
            }
        }

        $industry_populations = $this->sortIndustryPopulation($university_major);

        $population_total = $this->getIndustryPopulationTotals($industry_populations);

        $industry_populations = $this->calculatePopulationPercentages($industry_populations, $population_total);

        return $industry_populations;
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