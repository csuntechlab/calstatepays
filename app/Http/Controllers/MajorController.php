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
        $major_paths_wage = $major_paths->with('majorPathWage')->get();

        $someCollege = [];
        $bachelors = [];
        $post_bacc = [];
        $dataArray = $major_paths_wage->toArray();
        foreach($dataArray as $data) {
            if ($data['student_path'] == 1) {
                switch ($data['years']) {
                    case 2:
                        $someCollege['2'] = $data['major_path_wage'];
                        break;
                    case 5:
                        $someCollege['5'] = $data['major_path_wage'];
                        break;
                    case 10:
                        $someCollege['10'] = $data['major_path_wage'];
                        break;
                }
            } else if ($data['student_path'] == 2) {
                switch ($data['years']) {
                    case 2:
                        $bachelors['2'] = $data['major_path_wage'];
                        break;
                    case 5:
                        $bachelors['5'] = $data['major_path_wage'];
                        break;
                    case 10:
                        $bachelors['10'] = $data['major_path_wage'];
                        break;
                }
            } else if ($data['student_path'] == 3) {
                switch ($data['years']) {
                    case 2:
                        $post_bacc['2'] = $data['major_path_wage'];
                        break;
                    case 5:
                        $post_bacc['5'] = $data['major_path_wage'];
                        break;
                    case 10:
                        $post_bacc['10'] = $data['major_path_wage'];
                        break;
                }
            }
        }
        $majorData = [
            'major_id' =>$hegis_code,
            'university_id' => $university_id,
            'some_college'=> $someCollege,
            'bachelors' => $bachelors,
            'post_bacc' => $post_bacc
        ];
        return $majorData;
    }
}
