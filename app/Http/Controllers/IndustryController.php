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

    public function getAllImages()
    {
        $industries = collect(NaicsTitle::all())->map(function($industry){
            return[
                'name'  => $industry->naics_title,
                'image' =>$industry->image
            ];
        });
        return $industries;

    }
}
