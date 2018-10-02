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
                }, 'industryPathTypes.population', 'industryPathTypes.naicsTitle', 'industryPathTypes.industryWage'])
                    ->where('hegis_code', $hegis_code)
                    ->where('university_id', $university_id)
                    ->firstOrFail();

        $industry_populations= $this->helperRetriever->sortIndustryPopulation($university_major);
        
        $population_total = $this->helperRetriever->getIndustryPopulationTotals($industry_populations);
        
        $industry_populations = $this->helperRetriever->calculatePopulationPercentagesAndReturnImages($industry_populations, $population_total);

        return $industry_populations;
    }
}