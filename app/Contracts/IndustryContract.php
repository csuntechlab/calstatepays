<?php

namespace App\Contracts;

interface IndustryContract 
{
    public function getAllIndustryNaicsTitles();

    public function getIndustryPopulationByRank($hegis_code, $university_id);
    
    public function getIndustryPopulationByRankWithImages($hegis_code, $university_id);
}