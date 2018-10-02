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
        return $this->industryRetriever->getIndustryPopulationByRank($hegis_code, $university_id);
    }
    
    public function getIndustryPopulationByRankWithImages($hegis_code, $university_id)
    {
        return $this->industryRetriever->getIndustryPopulationByRankWithImages($hegis_code, $university_id);
    }
}
