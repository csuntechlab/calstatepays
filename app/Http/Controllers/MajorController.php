<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HEGISCode;
use App\Models\UniversityMajor;

class MajorController extends Controller
{
    public function getAllHegisCodes()
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

    public function getMajorEarnings($hegis_code, $university_id){
        $university_major = UniversityMajor::where('hegis_code', $hegis_code)
                                            ->where('university_id', $university_id)
                                            ->first();
        $major_paths = $university_major->majorPaths();
        dd($major_paths->where());
    }
}
