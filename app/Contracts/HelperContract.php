<?php

namespace App\Contracts;

interface HelperContract 
{
	public function checkOptIn($university_id);

    public function sortIndustryPopulation($university_major);

    public function getIndustryPopulationTotals($industry_populations);

    public function calculatePopulationPercentagesAndReturnImages($industry_populations, $population_total);

    public function populationHandler($industry, $population_total);

    public function calculatePopulationPercentages($industry_populations, $population_total);
}