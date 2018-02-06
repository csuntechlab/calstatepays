<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\IndustryWage;
use App\NaicsTitle;

class AggregateDataController extends Controller
{
    public function getAverageIncomeByIndustry()
    {
		return NaicsTitle::with('industryWage')->get();
    }
}
