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

    public function getIndustryData($collegeId, $industryTitle)
    {
        $client = new Client();
        $result = $client->get(env('LEARNANDEARN_URL') .'/industry-data/'. $collegeId .'/'. $industryTitle);
        return $result;
    }

    public function getMajorNames($universityId)
    {
        $client = new Client();
        $result = $client->get(env('LEARNANDEARN_URL') . '/major-data/' . $universityId);
        $result = \GuzzleHttp\json_decode($result->getBody());
        $newResult = [];
        $index = 0;
        foreach($result as $majorList) {
            foreach($majorList->majors as $key=>$major) {
                $ids = explode(":", $major->value);
                $newResult[$index]['major'] = $major->label;
                $newResult[$index]['majorId'] = $ids[0];
                $newResult[$index]['schoolId'] = $ids[1];
                $index += 1;
            }
        }
        $result = $newResult;
        return $result;
    } 

}
