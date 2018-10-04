<?php

namespace App\Contracts;

interface IndustryContract 
{
    public function getAllIndustryNaicsTitles();

    public function getIndustryPopulationByRankWithImages($hegis_code, $university_id);
}