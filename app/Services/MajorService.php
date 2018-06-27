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
        $fieldOfStudies =$fieldOfStudies->slice(1);
        dd($fieldOfStudies->toArray());
    }

    public function getHegisCategories($fieldOfStudyId): array
    {
        $fieldOfStudy = FieldOfStudy::with('hegisCategory')->with('hegisCategory.hegisCode')
                                    ->where('id', $fieldOfStudyId)->first();
        return $hegisCategory = $fieldOfStudy->hegisCategory->toArray();
    }
    
    public function getMajorEarnings($hegis_code, $university_id): array
    {
        return UniversityMajor::AllMajorPathWages($hegis_code, 1153);
    }
}