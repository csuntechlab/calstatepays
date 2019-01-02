<?php

namespace App\Services;


use App\Models\University;
use App\Contracts\UniversityContract;


class UniversityService implements UniversityContract
{
    public function getAllUniversities()
    {
        $data = University::all();

        $data = $data->map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['university_name'],
                'short_name' => $item['short_name'],
                'acronym' => $item['acronym'],
                'opt_in' => $item['opt_in']
            ];
        });

        return $data;
    }
}