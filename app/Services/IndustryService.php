<?php

namespace App\Services;

use App\Contracts\IndustryContract;
use App\Models\NaicsTitle;
use App\Models\UniversityMajor;

class IndustryService implements IndustryContract
{
    public function getAllIndustryNaicsTitles()
    {
        $allNaicsTitles = NaicsTitle::all()->map(function ($item, $key){
            return [
                'naics_code' => $item['naics_code'],
                'title'      => $item['naics_title'],
                'image'      => asset($item['image'])
            ];
        });
        return $allNaicsTitles;
    }

    public function getIndustryPopulationByRank($hegis_code, $university_id)
    {
        $university_major = UniversityMajor::where('hegis_code', $hegis_code)
                                            ->where('university_id', $university_id)
                                            ->first();
        $industryPathTypes = $university_major->industryPathTypes();

        $industryPopulations = $industryPathTypes->where('entry_status', 'FTF + FTT')
                                               ->where('student_path', 1)
                                               ->with('population')
                                               ->with('naicsTitle')
                                               ->get();
        $industryPopulations = $industryPopulations->sortByDesc('population.percentage_found')
                                                   ->values()
                                                   ->map(function($industry, $index = 0){
            $index++;
            return [
                'title'                  => $industry->naicsTitle->naics_title,
                'percentage'             => round($industry->population->percentage_found),
                'rank'                   => $index,
                'image'                  => asset($industry->naicsTitle->image)
            ];

        });
        return $industryPopulations;
    }
}