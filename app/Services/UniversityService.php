<?php

namespace App\Services;


use App\Models\University;
use App\Contracts\UniversityContract;


class UniversityService implements UniversityContract
{
    public function getAllUniversities()
    {
        $data = University::all()->toArray();
        return $data;
    }
}