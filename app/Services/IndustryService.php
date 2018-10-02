<?php

namespace App\Services;

use App\Contracts\IndustryContract;
use App\Contracts\HelperContract;
use App\Models\NaicsTitle;
use App\Models\University;
use App\Models\UniversityMajor;

class IndustryService implements IndustryContract
{
    protected $helperRetriever = null;

    public function __construct(HelperContract $helperContract)
    {
        $this->helperRetriever = $helperContract;
    }

    public function getAllIndustryNaicsTitles()
    {
        $allNaicsTitles = NaicsTitle::all()->map(function ($item, $key) {
            return [
                'naics_code' => $item['naics_code'],
                'title' => $item['naics_title'],
                'image' => asset($item['image'])
            ];
        });
        return $allNaicsTitles;
    }

    public function getIndustryPopulationByRank($hegis_code, $university_id)
    {
        /**
         *  Would here be the best choice to check if CSU Opts In or Not?
         */
        $this->helperRetriever->checkOptIn($university_id);
        
        $university_major = UniversityMajor::with(['industryPathTypes' => function ($query) {
                $query->where('entry_status', 'FTF + FTT');
                $query->where('student_path', 1);
                }, 'industryPathTypes.population', 'industryPathTypes.industryWage'])
                    ->where('hegis_code', $hegis_code)
                    ->where('university_id', $university_id)
                    ->firstOrFail();

        $industry_populations= $this->sortIndustryPopulation($university_major);
        
        $population_total = $this->getIndustryPopulationTotals($industry_populations);
        
        $industry_populations = $this->calculatePopulationPercentages($industry_populations, $population_total);

        return $industry_populations;
    }


    public function getIndustryPopulationByRankWithImages($hegis_code, $university_id)
    {
        /**
         *  Would here be the best choice to check if CSU Opts In or Not?
         */
        $this->helperRetriever->checkOptIn($university_id);
        
        $university_major = UniversityMajor::with(['industryPathTypes' => function ($query) {
                $query->where('entry_status', 'FTF + FTT');
                $query->where('student_path', 1);
                }, 'industryPathTypes.population', 'industryPathTypes.naicsTitle', 'industryPathTypes.industryWage'])
                    ->where('hegis_code', $hegis_code)
                    ->where('university_id', $university_id)
                    ->firstOrFail();

        $industry_populations= $this->sortIndustryPopulation($university_major);
        
        $population_total = $this->getIndustryPopulationTotals($industry_populations);
        
        $industry_populations = $this->calculatePopulationPercentagesAndReturnImages($industry_populations, $population_total);

        return $industry_populations;
    }

    private function sortIndustryPopulation($university_major)
    {
        $industry_populations = $university_major->industryPathTypes->sortByDesc('population.population_found')->values();
        return $industry_populations;
    } 

    private function getIndustryPopulationTotals($industry_populations) {
        $total = 0;
        foreach($industry_populations as $pop) {
            if($pop->population->population_found != null){
                $total += $pop->population->population_found;
            }
        }
        return $total;
    }

    private function calculatePopulationPercentagesAndReturnImages($industry_populations, $population_total) {
        $final =  $industry_populations = $industry_populations
            ->map(function ($industry,$index = 0) use($population_total){
                $index++;
                $percentage = $this->populationHandler($industry,$population_total);
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

    private function populationHandler($industry, $population_total){
        if( ($industry->population->population_found!=null) && ($population_total != null) ){
            $percentage = round( ($industry->population->population_found/$population_total)*100, 0, PHP_ROUND_HALF_DOWN);
            return $percentage;
        }
        return null;
    }

    private function calculatePopulationPercentages($industry_populations, $population_total) {
        $final =  $industry_populations = $industry_populations
            ->map(function ($industry,$index = 0) use($population_total){
                $index++;
                $percentage = $this->populationHandler($industry,$population_total);
                return [
                    'title' => $industry->naicsTitle->naics_title,
                    'percentage' => $percentage,
                    'rank' => $index,
                    'industryWage' => $industry->industryWage->avg_annual_wage_5
                ];
            });
        return $final;
    }
}