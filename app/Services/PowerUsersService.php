<?php

namespace App\Services;

use App\Models\University;
use App\Models\PowerUsersData;
use App\Contracts\PowerUsersContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        if ($powerUserData->isEmpty()) {
            $message = 'No Power User Data';
            throw new ModelNotFoundException($message, 409);
        }

        return $powerUserData->groupBy('university_id');
    }
}