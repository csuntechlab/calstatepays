<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FREFormRequest;
use App\Contracts\PfreContract;
use Illuminate\Support\Facades\Cache;

class PfreController extends Controller
{
    protected $pfreRetriever;

    public function __construct(PfreContract $pfreContract)
    {
        $this->pfreRetriever = $pfreContract;
    }

    public function getFREData(FREFormRequest $request)
    {
        $key = "getFreData:" . ":" . $request->major . ":" . $request->university . ":" . $request->age_range . ":" . $request->education_level . ":" . $request->annual_earnings . ":" . $request->financial_aid;

        if (Cache::has($key)) {
            $data = Cache::get($key);
            $data = json_decode($data);
            return response()->json($data);
        }

        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }
        
        $freData = $this->pfreRetriever->getFREData($request);
        $data = [
            'majorId' => $request->major,
            'universityId' => $request->university,
            'fre' => [
                'timeToDegree' => $freData['time_to_degree'],
                'earningsYearFive' => $freData['earnings_5_years'],
                'returnOnInvestment' => $freData['roi']
            ]
        ];

        $value = json_encode($data);
        Cache::forever($key, $value);

        return $data;
    }
}
