<?php

namespace App\Services;

use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\UniversityMajor;
use App\Contracts\MajorContract;

class MajorService implements MajorContract
{
    public function getAllHegisCodes(): array 
    {
       $allHegisCodes = HEGISCode::get()->unique()->map(function ($item){
           return [
            'hegis_code' => $item['hegis_code'],
            'major' => $item['major'],
            'university' => $item['university']
           ];

        });
        return $allHegisCodes->toArray();
    }

    public function getAllFieldOfStudies(): array
    {
        $fieldOfStudies = FieldOfStudy::all();
        return $fieldOfStudies->toArray();
    }

    public function getMajorEarnings($hegis_code, $university_id): array
    {
        $majorPathWages = UniversityMajor::AllMajorPathWages($hegis_code, 1153);
        return $majorPathWages->toArray();
    }
}