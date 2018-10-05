<?php

namespace App\Http\Controllers;

use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use App\Contracts\IndustryContract;

class IndustryController extends Controller
{
    protected $industryRetriever = null;

    public function __construct(IndustryContract $industryContract)
    {
        $this->industryRetriever = $industryContract;
    }

    public function getAllIndustryNaicsTitles()
    {
        return $this->industryRetriever->getAllIndustryNaicsTitles();
    }

    public function getIndustryPopulationByRankWithImages($hegis_code,$universityName)
    {
        return $this->industryRetriever->getIndustryPopulationByRankWithImages($hegis_code,$universityName);
    }
    
    public function getIndustryPopulationByRank($hegis_code,$universityName)
    {
        return $this->industryRetriever->getIndustryPopulationByRank($hegis_code, $universityName);
    }
}
