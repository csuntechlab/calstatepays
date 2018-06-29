<?php

namespace App\Services;

use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\UniversityMajor;
use App\Contracts\MajorContract;
use Illuminate\Pagination\Paginator;

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
    public function getHegisCode($name)
    {
        $hegis_code = HEGISCode::where('major', $name)->first(['hegis_code']);
        if($hegis_code == null){
            dd($name);
        };
        return $hegis_code;
    }

    public function getUniversityMajorId($hegisCode, $universityId)
    {
        $universityMajorId = UniversityMajor::where('hegis_code', $hegisCode)
                                                ->where('university_id', $universityId)
                                                ->first(['id']);
        if($hegisCode == null || $universityId == null){
            dd($hegisCode, $universityId);
        };
        return $universityMajorId;
    }
}