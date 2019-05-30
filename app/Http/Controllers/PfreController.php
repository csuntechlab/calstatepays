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
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }

        $key = "getFreData:" . $request->major . ":" . $request->entry_status . ":" . $request->in_school_earning . ":" . $request->financial_aid;

        if (Cache::has($key)) {
            $data = Cache::get($key);
            $data = json_decode($data);
            return response()->json($data);
        }

        $freData = $this->pfreRetriever->getFREData($request);

        $value = json_encode($freData);
        Cache::forever($key, $value);

        return $freData;
    }
}
