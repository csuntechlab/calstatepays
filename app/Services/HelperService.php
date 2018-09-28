<?php

namespace App\Services;

use App\Contracts\IndustryContract;
use App\Models\NaicsTitle;
use App\Models\University;
use App\Models\UniversityMajor;

class HelperService 
{
    public function checkOptIn($university_id)
    {
        University::where('id',$university_id)->where('opt_in',1)->firstOrFail();
    }

    public function handlePopulationCalculation($university_major)
    {
        $industry_populations = $university_major->industryPathTypes->sortByDesc('population.population_found')->values();
        $population_total = $this->getIndustryPopulationTotals($industry_populations);
        $industry_populations = $this->calculatePopulationPercentages($industry_populations, $population_total);
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

    private function calculatePopulationPercentages($industry_populations, $population_total) {
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
}