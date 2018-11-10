<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\PfreContract;

class PfreController extends Controller
{
    protected $majorRetriever;

    public function __construct(PfreContract $majorContract)
    {
        $this->majorRetriever = $majorContract;
    }

    public function getFREData(Request $request)
    {
        $freData = $this->majorRetriever->getFREData($request);
        return [
            'majorId' => $request->major,
            'universityId' => $request->university,
            'fre' => [
                'timeToDegree' => $freData['time_to_degree'],
                'earningsYearFive' => $freData['earnings_5_years'],
                'returnOnInvestment' => $freData['roi']
            ]
        ];
    }
}
