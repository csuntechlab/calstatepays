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
        $university_major = UniversityMajor::with(['industryPathTypes' =>  function($query) {
            $query->where('entry_status', 'ALL');
            $query->where('student_path', 4);
        },'industryPathTypes.population','industryPathTypes.naicsTitle', 'industryPathTypes.industryWages'])->get()
            ->where('hegis_code', $hegis_code)
            ->where('university_id', $university_id)
            ->first();

        $industryPopulations = $university_major->IndustryPathTypes->sortByDesc('population.percentage_found')
        ->values()->map(function ($university_major, $index = 0 ){
                $index++;
            return[
                        'title'                  => $university_major->naicsTitle->naics_title,
                        'percentage'             => round($university_major->population->percentage_found),
                        'rank'                   => $index,
                        'image' => asset($university_major->naicsTitle->image),
                        'industry_wages' => $university_major->industry_wages
                    ];
            });
        return $industryPopulations;
    }
}