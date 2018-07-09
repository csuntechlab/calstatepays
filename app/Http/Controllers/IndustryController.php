<?php

namespace App\Http\Controllers;

use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use App\Contracts\IndustryContract;

class IndustryController extends Controller
{
    protected $industryRetriever;

    public function __construct(IndustryContract $industryContract)
    {
        $this->industryRetriever = $industryContract;
    }

    public function getAllIndustryNaicsTitles()
    {
        return $this->industryRetriever->getAllIndustryNaicsTitles();
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
                'percentage'             => round($industry->population->percentage_found),
                'rank'                   => $index,
                'image'                  => asset($industry->naicsTitle->image)
            ];

        });
        return $industryPopulations;
    }
}
