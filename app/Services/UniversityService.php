<?php

namespace App\Services;

use App\Contracts\UniversityContract;
use App\Models\University;

class UniversityService implements UniversityContract
{
    public function getAllUniversities()
    {
        $data = University::all()->toArray();
        return $data;
    }
}