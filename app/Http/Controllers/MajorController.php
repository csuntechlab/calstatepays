<?php

namespace App\Http\Controllers;

use App\Models\FieldOfStudy;
use Illuminate\Http\Request;
use App\Models\HEGISCode;
use App\Models\UniversityMajor;
use App\Contracts\MajorContract;

class MajorController extends Controller
{
    protected $majorRetriever;

    public function __construct(MajorContract $majorContract)
    {
        $this->majorRetriever = $majorContract;
    }
    
    public function getAllHegisCodesByUniversity( $universityId )
    {
        return $this->majorRetriever->getAllHegisCodesByUniversity($universityId);
    }
    
    public function getAllFieldOfStudies()
    {
        return $this->majorRetriever->getAllFieldOfStudies();
    }
    
    public function getMajorEarnings($hegis_code, $university_id){
        $university_major = $this->majorRetriever->getMajorEarnings($hegis_code, $university_id);
        foreach($university_major as $data) {
            $years = $data['years'];
            if ($data['student_path'] == 2) {
                $someCollege[$years] = $this->extractWageByYearKey($data);
            } else if ($data['student_path'] == 1) {
                $bachelors[$years] = $this->extractWageByYearKey($data);
            } else if ($data['student_path'] == 4) {
                $post_bacc[$years] = $this->extractWageByYearKey($data);
            }
        }

        $majorData = [
            'majorId' =>$hegis_code,
            'universityId' => $university_id,
            'someCollege'=> isset($someCollege) ? $someCollege : null,
            'bachelors' => isset($bachelors) ? $bachelors : null,
            'postBacc' => isset($post_bacc) ? $post_bacc : null
        ];
        return $majorData;
    }

    public function extractWageByYearKey($array){
        $studentPathArray = null;
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
            case 15:
                $studentPathArray = $array['major_path_wage'];
                break;
        }
        return $studentPathArray;
    }

    public function getFREData(Request $request){
        $freData = $this->majorRetriever->getFREData($request);
        return [
            'majorId'      => $request->major,
            'universityId' => $request->university,
            'fre' => [
                'timeToDegree'       => $freData['time_to_degree'],
                'earningsYearFive'   => $freData['earnings_5_years'],
                'returnOnInvestment' => $freData['roi']
            ]
        ];
    }

    public function filterByFieldOfStudy($universityId,$fieldOfStudyId)
    {
        $hegisData = $this->majorRetriever->getHegisCategories($universityId,$fieldOfStudyId);
        
        if($hegisData == []){
            return [[]];
        }

        $data[] = array_map(function($hegis){
                return  [
                    'major'             => $hegis['university_majors']['major'],
                    'hegisCode'         => $hegis['hegis_code'],
                    'hegis_category_id' => $hegis['hegis_category_id'],
                ];
        }, $hegisData);

        $data = array_collapse($data);
        sort($data);
        return [$data];
    }

}
