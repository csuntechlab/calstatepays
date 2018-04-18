<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NaicsTitle;
use Storage;
use Image;

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

    public function getAllImage()
    {
        $partialImagePaths = Storage::disk('public')->files('images');
        $industryImages = collect($partialImagePaths)->map(function($path){
            $industryName = basename($path, '.jpg');
            return [
                'name'       => ucwords($industryName),
                'image_path' => Storage_Path('app/public/') . $path
            ];
        });
        return $industryImages;
    }

    public function getImage($industry)
    {

    }
}
