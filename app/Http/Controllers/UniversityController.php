<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HEGISCode;

class UniversityController extends Controller
{
    public function getAllHegisCodes()
    {
        $allHegisCodes = HEGISCode::get()->unique()->map(function ($item){
           return [
            'hegis_code' => $item['hegis_code'],
            'major' => $item['major'],
            'university' => $item['university']
           ];

        });
        return $allHegisCodes->toArray();
    }
}
