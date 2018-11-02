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
        return $this->industryRetriever->getIndustryPopulationByRank($request->major, $request->university,$request->degreeLevel);    
    }
}
