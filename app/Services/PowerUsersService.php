<?php

namespace App\Services;

use App\Contracts\PowerUsersContract;
use App\Models\PowerUser;

class PowerUsersService implements PowerUsersContract
{
    public function getPowerUserDataByUniversity($university, $path_id)
    {
        $university = University::where('short_name', $university)
            ->where('opt_in', 1)
            ->firstOrFail();

        $universityId = $university->id;


        $data = PowerUser::where('university_id', $universityId)->where('path_type_id', $path_id)->firstOrFail();

        dd($data);


    }
}