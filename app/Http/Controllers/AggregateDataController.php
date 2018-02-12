<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IndustryWage;
use App\Models\NaicsTitle;

class AggregateDataController extends Controller
{
    public function getAverageIncomeByIndustry()
    {
		$naicsTitles =  NaicsTitle::with('industryWage')->get()->keyBy('naics_code');
		foreach ($naicsTitles as $industry) {
			$industryWages = $industry->industryWage->toArray();
			$avg_annual_wage_5 = array_column( $industryWages ,'avg_annual_wage_5');
			$avg_annual_wage_10 = array_column( $industryWages ,'avg_annual_wage_10');
			$industry['avg_annual_wage_5'] = array_sum($avg_annual_wage_5) / count($avg_annual_wage_5);
			$industry['avg_annual_wage_10'] = array_sum($avg_annual_wage_10) / count($avg_annual_wage_10);
		}
		return $naicsTitles;
    }
}
