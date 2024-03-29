<?php

namespace App\Http\Controllers;

use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use App\Contracts\IndustryContract;
use Validator;
use App\Http\Requests\IndustryFormRequest;
use Illuminate\Support\Facades\Cache;

class IndustryController extends Controller
{
    protected $industryRetriever = null;

    public function __construct(IndustryContract $industryContract)
    {
        $this->industryRetriever = $industryContract;
    }

    public function getAllIndustryNaicsTitles()
    {
        $key = 'naicsTitles';

        if (Cache::has($key)) {
            $data = Cache::get($key);
            return json_decode($data);
        }

        $data = $this->industryRetriever->getAllIndustryNaicsTitles();
        $value = json_encode($data);

        Cache::forever($key, $value);

        return $data;
    }

    public function getIndustryPopulationByRankWithImages(IndustryFormRequest $request)
    {

        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }

        $key = 'industryPopulationByRankWithImages:' . $request->major . ':' . $request->university;

        if (Cache::has($key)) {
            $data = Cache::get($key);
            $data = json_decode($data);
            return response()->json($data);
        }

        $data = $this->industryRetriever->getIndustryPopulationByRankWithImages($request->major, $request->university);

        $value = json_encode($data);
        Cache::forever($key, $value);
        return $data;
    }

    public function getIndustryPopulationByRank(IndustryFormRequest $request)
    {

        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }

        $key = 'industryPopulationByRank:' . $request->major . ':' . $request->university;

        if (Cache::has($key)) {
            $data = Cache::get($key);
            $data = json_decode($data);
            return response()->json($data);
        }

        $data = $this->industryRetriever->getIndustryPopulationByRank($request->major, $request->university);
        $value = json_encode($data);
        Cache::forever($key, $value);
        return $data;
    }
}
