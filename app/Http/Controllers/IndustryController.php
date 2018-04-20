<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NaicsTitle;
use App\Models\UniversityMajor;

class IndustryController extends Controller
{

    public function getAllIndustryNaicsTitles()
    {
        $allNaicsTitles = NaicsTitle::get()->map(function ($item, $key){
            return [
                'naics_code' => $item['naics_code'],
                'title'      => $item['naics_title']
            ];
        });
        return $allNaicsTitles->toArray();
    }

    public function getAllImages()
    {
        $industries = collect(NaicsTitle::all())->map(function($industry){
            return[
                'name'  => $industry->naics_title,
                'image' => $industry->image
            ];
        });
        return $industries;
    }

    public function getIndustryPopulationByRank($hegis_code, $university_id)
    {
        $university_major = UniversityMajor::where('hegis_code', $hegis_code)
                                            ->where('university_id', $university_id)
                                            ->first();
        $industryPathTypes = $university_major->industryPathTypes();
        $industryPopulations = $industryPathTypes->where('entry_status', 'All')
                                               ->where('student_path', 4)
                                               ->with('population')
                                               ->with('naicsTitle')
                                               ->get();


        $industryPopulations = $industryPopulations->sortByDesc('population.percentage_found')
                                                   ->values()
                                                   ->map(function($industry, $index = 0){
            $index++;
            return [
                'title'                  => $industry->naicsTitle->naics_title,
                'percentage'             => $industry->population->percentage_found,
                'rank'                   => $index,
                'image'                  => $industry->naicsTitle->image
            ];

        });
        return $industryPopulations;
    }
}
