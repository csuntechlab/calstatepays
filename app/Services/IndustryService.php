<?php

namespace App\Services;

use App\Contracts\IndustryContract;
use App\Models\NaicsTitle; 

class IndustryService implements IndustryContract
{
    public function getAllIndustryNaicsTitles()
    {
        $allNaicsTitles = NaicsTitle::all()->map(function ($item, $key){
            return [
                'naics_code' => $item['naics_code'],
                'title'      => $item['naics_title'],
                'image'      => asset($item['image'])
            ];
        });
        return $allNaicsTitles;
    }
}