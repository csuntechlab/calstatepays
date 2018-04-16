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

    public function getIndustryImages()
    {
        $imageNames = Storage::disk('public')->files('images');
        dd(preg_mastch('/',$imageNames[0]));
        $imageNames = collect($imageNames)->map(function($image){
            return [
                'image_path' => Storage_Path('app/public/') . $image
            ];
        });
        return $imageNames;
        /*foreach($imageNames as $name){
            $imagePath = Storage_Path('app/public/') . $name;

        }
        $image1 =  Image::make($imagePath . $imageNames[0])->response('jpg');
        return $image1;*/
    }
}
