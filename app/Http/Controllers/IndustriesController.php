<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NaicsTitle;

class IndustriesController extends Controller
{
    public function getAllIndustryNaicsTitles()
    {
        $allNaicsTitles = NaicsTitle::all();
        dd($allNaicsTitles);
    }
}
