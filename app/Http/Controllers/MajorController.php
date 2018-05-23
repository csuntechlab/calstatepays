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
        $university_major = UniversityMajor::AllMajorPathWages($hegis_code, $university_id);

        foreach($university_major as $data) {
            $years = $data['years'];
            if ($data['student_path'] == 1) {
                $someCollege[$years] = $this->extractWageByYearKey($data);
            } else if ($data['student_path'] == 2) {
                $bachelors[$years] = $this->extractWageByYearKey($data);
            } else if ($data['student_path'] == 3) {
                $post_bacc[$years] = $this->extractWageByYearKey($data);
            }
        }

        $majorData = [
            'majorId' =>$hegis_code,
            'universityId' => $university_id,
            'someCollege'=> $someCollege,
            'bachelors' => $bachelors,
            'postBacc' => $post_bacc
        ];
        return $majorData;
    }

    public function extractWageByYearKey($array){
        switch ($array['years']) {
            case 2:
                $studentPathArray = $array['major_path_wage'];
                break;
            case 5:
                $studentPathArray = $array['major_path_wage'];
                break;
            case 10:
                $studentPathArray = $array['major_path_wage'];
                break;
        }
        return $studentPathArray;
    }
}
