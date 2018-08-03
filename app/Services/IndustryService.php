<?php

namespace App\Services;

use App\Contracts\IndustryContract;
use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use function foo\func;

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

        $industryPathTypes = $university_major->industryPathTypes;

        $industryPopulations = $industryPathTypes->sortByDesc('population.percentage_found')
            ->values()
            ->map(function ($industry, $index = 0) {
                $index++;
                return [
                    'title' => $industry->naicsTitle->naics_title,
                    'percentage' => round($industry->population->percentage_found),
                    'rank' => $index,
                    'image' => asset($industry->naicsTitle->image),
                    'industryWage' => (!is_null($industry->industryWage->avg_annual_wage_5)) ? $industry->industryWage->avg_annual_wage_5 : "Not Available"
                ];
            });
        return $industryPopulations;
    }
}

//
//            =======
//                                                $query->where('student_path', 1)
//                                                      ->where('entry_status', 'FTF + FTT');
//                                                 },'industryPathTypes.population','industryPathTypes.naicsTitle'])
//                                                ->where('hegis_code', $hegis_code)
//                                                ->where('university_id', $university_id)
//                                                ->first();
//
//        $industryPathTypes = $university_major->industryPathTypes;
//
//        $industryPopulations = $industryPathTypes->sortByDesc('population.percentage_found')
//                                                   ->values()
//                                                   ->map(function($industry, $index = 0){
//            $index++;
//            return [
//                'title'                  => $industry->naicsTitle->naics_title,
//                'percentage'             => round($industry->population->percentage_found),
//                'rank'                   => $index,
//                'image'                  => asset($industry->naicsTitle->image)
//            ];
//
//        });
//>>>>>>> dev