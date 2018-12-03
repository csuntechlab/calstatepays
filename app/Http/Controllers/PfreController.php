<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FREFormRequest;
use App\Contracts\PfreContract;

class PfreController extends Controller
{
    protected $pfreRetriever;

    public function __construct(PfreContract $pfreContract)
    {
        $this->pfreRetriever = $pfreContract;
    }

    public function getFREData(FREFormRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }
        
        $freData = $this->pfreRetriever->getFREData($request);
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
