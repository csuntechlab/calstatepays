<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\PowerUsersContract;
use Illuminate\Support\Facades\Cache;

class PowerUsersController extends Controller
{
    protected $powerUsersRetrieval;

    public function __construct(PowerUsersContract $powerUsersContract)
    {
        $this->powerUsersRetrieval = $powerUsersContract;
    }

    public function getPowerUserDataByUniversity($university, $path_id)
    {
        return $this->powerUsersRetrieval->getPowerUserDataByUniversity($university, $path_id);
    }

    public function getPowerUsersCardImages(){
        $key = 'powerUserCardImagesCSP';
        // if (Cache::has($key)) {
        //     $data = Cache::get($key);
        //     $data = json_decode($data);
        //     return response()->json($data);
        // }
        
        $data =  $this->powerUsersRetrieval->getPowerUsersCardImages();
        // $value = json_encode($data);
        // Cache::forever($key, $value);
        return $data;
    }
}
