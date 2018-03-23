<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class LearnAndEarnController extends Controller
{
    public function getCollegeMajor($schoolId, $majorId)
    {
        $client = new Client(); //GuzzleHttp\Client
        $result = $client->get(env('LEARNANDEARN_URL') . '/major-data/'. $schoolId .'/'. $majorId);
        return $result;
    }

    public function getMajorNames($universityId)
    {
        $client = new Client();
        $result = $client->get(env('LEARNANDEARN_URL') . '/major-data/' . $universityId);
        return $result;
    } 

}
