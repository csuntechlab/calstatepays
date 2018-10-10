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
    
    public function getAllHegisCodesByUniversity( $university_name )
    {
        return $this->majorRetriever->getAllHegisCodesByUniversity( $university_name );
    }
    
    public function getAllFieldOfStudies()
    {
        return $this->majorRetriever->getAllFieldOfStudies();
    }
    
    public function getMajorEarnings($hegis_code,$university_name)
    {
        $university_major = $this->majorRetriever->getMajorEarnings($hegis_code, $university_name);

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

        // question, do we need to return the major id?
        $nullArray = [
            '2' =>
            [
                "_25th"=>null,
                "_50th"=>null,
                "_75th"=>null
            ],
            '5' =>
            [
                "_25th" => null,
                "_50th" => null,
                "_75th" => null
            ],
            '10' =>
            [
                "_25th" => null,
                "_50th" => null,
                "_75th" => null
            ],
            '15' =>
            [
                "_25th" => null,
                "_50th" => null,
                "_75th" => null
            ]
        ];

        $majorData = [
            'majorId' =>$hegis_code,
            'universityName' => $university_name,
            'someCollege'=> isset($someCollege) ? $someCollege : $nullArray,
            'bachelors' => isset($bachelors) ? $bachelors : $nullArray,
            'postBacc' => isset($post_bacc) ? $post_bacc : $nullArray
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

    public function getFREData(Request $request)
    {
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

    public function filterByFieldOfStudy($universityName,$fieldOfStudyId)
    {
        $hegisData = $this->majorRetriever->getHegisCategories($universityName,$fieldOfStudyId);
        
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
