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
        $result = $client->get('https://www.metalab.csun.edu/learnandearn/api/major-data/'. $schoolId .'/'. $majorId);
        return $result;
    }
}
