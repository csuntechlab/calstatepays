<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NaicsTitle;
use Storage;
use Image;

class IndustryController extends Controller
{
    private $industries = [
        'administration', 'agriculture', 'art',
        'company', 'construction',
        'education', 'estate',
        'finance', 'food',
        'health',
        'manufacturing',
        'oil',
        'professional',
        'retail',
        'transportation',
        'utilities',
        'waste', 'wholesale'
    ];

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
        //Return all images for every industry
        $partialImagePaths = Storage::disk('public')->files('images');
        dd($partialImagePaths);
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
        $partialImagePaths = Storage::disk('public')->files('images');
        $industryName = strtolower($industry);
        /*if(in_array($industryName, $this->industries)){
            $industryData = collect($partialImagePaths)->filter(function($value{
                $collectionIndustryName = basename($path, '.jpg');
            });
        }*/
        //return
        return 'false';
    }
}
