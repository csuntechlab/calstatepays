<?php

namespace App\Contracts;

interface IndustryContract 
{
    public function getAllIndustryNaicsTitles();

    public function getIndustryPopulationByRankWithImages($hegis_code,$universityName, $degreeLevel);

    public function getIndustryPopulationByRank($hegis_code,$universityName,$degreeLevel);
}