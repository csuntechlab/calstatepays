<?php

namespace App\Http\Controllers;

use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use App\Contracts\IndustryContract;
use Validator;
use App\Http\Requests\IndustryFormRequest;

class IndustryController extends Controller
{
    protected $industryRetriever = null;

    public function __construct(IndustryContract $industryContract)
    {
        $this->industryRetriever = $industryContract;
    }

    public function getAllIndustryNaicsTitles()
    {
        return $this->industryRetriever->getAllIndustryNaicsTitles();
    }

    public function getIndustryPopulationByRankWithImages(IndustryFormRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }
        return $this->industryRetriever->getIndustryPopulationByRankWithImages($request->major, $request->university,$request->degreeLevel);
    }
    
    public function getIndustryPopulationByRank(IndustryFormRequest $request)
    {
        // if there is an error, return the error messages, with response code 400
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }
        $industry_data =  $this->industryRetriever->getIndustryPopulationByRank($request->major, $request->university);

        foreach ($industry_data as $key=>$data) {
            if ($data['student_path'] == 2) {
                $someCollege[$key] = $data;
            } else if ($data['student_path'] == 1) {
                $bachelors[$key] = $data;
            } else if ($data['student_path'] == 4) {
                $post_bacc[$key] = $data;
            }
        }

        $majorData = [
            'majorId' => $request->major,
            'universityName' => $request->university,
            'someCollege' => array_values($someCollege),
            'bachelors' => array_values($bachelors) ,
            'postBacc' => array_values($post_bacc),
        ];
        return $majorData;
    }
}
