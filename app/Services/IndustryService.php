<?php

namespace App\Services;

use App\Contracts\IndustryContract;
use App\Models\NaicsTitle;
use App\Models\UniversityMajor;

class IndustryService implements IndustryContract
{
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

        $university_major = UniversityMajor::with(['industryPathTypes' => function ($query) {
            $query->where('entry_status', 'FTF + FTT');
            $query->where('student_path', 1);
        }, 'industryPathTypes.population', 'industryPathTypes.naicsTitle', 'industryPathTypes.industryWage'])
            ->where('hegis_code', $hegis_code)
            ->where('university_id', $university_id)
            ->first();

        $industryPopulations = $university_major->industryPathTypes->sortByDesc('population.percentage_found')->values();

        $total = 0;
        foreach($industryPopulations as $pop) {
            if($pop->population->population_found != null){
                $total += $pop->population->population_found;
            }
        }

        $industryPopulations = $industryPopulations
            ->map(function ($industry,$index = 0) use($total){
                $index++;
                if( ($industry->population->population_found != null) && ($total != null) ){
                    $percentage = round( ($industry->population->population_found/$total)*100 );
                }else{
                    $percentage = null;
                }
                return [
                    'title' => $industry->naicsTitle->naics_title,
                    'percentage' => $percentage,
                    'rank' => $index,
                    'image' => asset($industry->naicsTitle->image),
                    'industryWage' => $industry->industryWage->avg_annual_wage_5
                ];
            });
        return $industryPopulations;
    }
}