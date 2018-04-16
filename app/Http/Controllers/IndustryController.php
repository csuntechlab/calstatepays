<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NaicsTitle;

class IndustryController extends Controller
{
    public function getAllIndustryNaicsTitles()
    {
        $allNaicsTitles = NaicsTitle::get()->map(function ($item, $key){
            return [
                'naics_code' => $item['naics_code'],
                'title'      => $item['naics_title']
            ];
        });
        return $allNaicsTitles->toArray();
    }

    public function getIndustryImages()
    {

    }
}
