<?php

namespace App\Services;

use App\Models\University;
use App\Contracts\PowerUsersContract;
use App\Models\PowerUsersData;

class PowerUsersService implements PowerUsersContract
{
    public function getPowerUserDataByUniversity($university, $path_id)
    {
        $university = University::where('short_name', $university)
            ->where('opt_in', 1)
            ->firstOrFail();

        $universityId = $university->id;

        $powerUserData = PowerUsersData::where('university_id', $universityId)->where('path_id', $path_id)->where('opt_in', 1)->firstOrFail();


        $iFrameString['iframe_string'] = $powerUserData['iframe_string'];

        return $iFrameString;
    }


    public function getTableauOptInUniversityData()
    {

        $powerUserData = PowerUsersData::where('opt_in', 1)->get();

        $powerUserData = $powerUserData->groupBy('university_id');

        return $powerUserData;
    }
}