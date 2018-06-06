<?php

namespace App\Http\Controllers;

use App\Models\FieldOfStudy;
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

    public function getAllFieldOfStudies()
    {
        $fieldOfStudies = FieldOfStudy::all();
        return $fieldOfStudies;
    }

    public function getMajorEarnings($hegis_code, $university_id){
        $university_major = UniversityMajor::AllMajorPathWages($hegis_code, 1153);

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

    public function getFREData(Request $request){
        $data = UniversityMajor::where('hegis_code', $request->major)
            ->where('university_id', $request->university)
            ->with(['studentBackground' => function($query) use($request){
                $query->where('age_range_id', $request->age_range);
                $query->where('education_level', $request->education_level);
            },'studentBackground.investment' => function ($query) use ($request){
                $query->where('annual_earnings_id', $request->annual_earnings);
                $query->where('annual_financial_aid_id', $request->financial_aid);
            }])->firstOrFail();
        $freData = $data->studentBackground->first()->investment->first();
        return [
            'majorId'      => $request->major,
            'universityId' => $request->university,
            'fre' => [
                'timeToDegree'       => $freData->time_to_degree,
                'earningsYearFive'   => $freData->earnings_5_years,
                'returnOnInvestment' => $freData->roi
            ]
        ];
    }

    public function filterByFieldOfStudy($fieldOfStudyId)
    {
        $fieldOfStudy = FieldOfStudy::with('hegisCategory')->with('hegisCategory.hegisCode')
                                    ->where('id', $fieldOfStudyId)->first();
        $hegisCategory = $fieldOfStudy->hegisCategory()->get();

        foreach($hegisCategory as $category){
            $hegisCodes = $category->hegisCode;
            if(!is_null($hegisCodes)){
                $data[] = $hegisCodes->map(function($code){
                    return  [
                        'hegisCode'         => $code->hegis_code,
                        'hegis_category_id' => $code->hegis_category_id,
                        'major'             => $code->major
                    ];
                });
            }
        }
        return [
            array_collapse($data)
        ];
    }

}
