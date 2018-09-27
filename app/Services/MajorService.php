<?php

namespace App\Services;

use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\MajorPath;
use App\Models\UniversityMajor;
use App\Models\University;
use App\Contracts\MajorContract;
use Illuminate\Pagination\Paginator;

class MajorService implements MajorContract
{
    public function getAllHegisCodesByUniversity( $universityId ): array 
    {
        $allHegisCodes = UniversityMajor::where('university_id',$universityId)
                            ->with(['university' => function($query) {
                                $query->where('opt_in',1);
                            }])
                            ->orderBy('major','asc')
                            ->get();

        // Given the situation where the CSU Opts out
        // TODO: MUST CHECK WITH FRONT END HOW TO DEAL WITH NULL
        if($allHegisCodes[0]->university == null)
        {
            return [null];
        }

        $allHegisCodes = $allHegisCodes
                            ->map(function ($item){
                                return [
                                    'major' => $item['major'],
                                    'hegis_code' => $item['hegis_code'],
                                    'university_id' => $item['university']->id
                                ];
                            });

        return $allHegisCodes->toArray();
    }

    public function getAllFieldOfStudies(): array
    {
        $fieldOfStudies = FieldOfStudy::orderBy('name', 'asc')->get();
        return $fieldOfStudies->toArray();
    }

    public function getHegisCategories($universityId,$fieldOfStudyId): array
    {
        $fieldOfStudy = FieldOfStudy::with( ['hegisCategory.hegisCode.universityMajors' => function ($query) use ($universityId) {
                                $query->where('university_id',$universityId);  
                                }])
                                ->where('id', $fieldOfStudyId)
                                ->firstOrFail();
        if ( empty($fieldOfStudy) ){
            return [];
        }
        else if ( empty($fieldOfStudy->hegisCategory) ){
            return [];
        }
        
        $hegisCategory = $fieldOfStudy->hegisCategory;
        
        $hegisData = [];
        foreach($hegisCategory as $category){
            $hegisCodes = $category['hegisCode'];
            $hegisData[] = $hegisCodes->toArray();
        }    
        $hegisData = array_collapse($hegisData); 
    
        $data = [];
        foreach( $hegisData as $hegis ){
            if($hegis['university_majors']!==null){
                $data[] = $hegis;
            }
        }
        return $data;
    }
    
    public function getMajorEarnings($hegis_code, $university_id): array
    {
        $universityMajor = UniversityMajor::where('hegis_code', $hegis_code)
                            ->with(['university' => function($query) {
                                $query->where('opt_in',1);
                            }])
                            ->where('university_id', $university_id)
                            ->with('majorPaths.majorPathWage')
                            ->firstOrFail();

        // situation where CSU opts out
        // Might want to refactor this method?
        if($universityMajor->university == null)
        {
            return [];
        }
                            
        if ( empty($universityMajor) ){
            return [];
        }
        else if ( empty($universityMajor->majorPaths) ){
            return [];
        }

        $universityMajor = $universityMajor->majorPaths->toArray();                            
        return $universityMajor;
    }
    public function getHegisCode($name)
    {
        $hegis_code = HEGISCode::where('major', $name)->first(['hegis_code']);
        if($hegis_code == null){
            dd($name);
        };
        return $hegis_code;
    }

    public function getUniversityMajorId($hegisCode, $universityId, $major)
    {

        $universityMajorId = UniversityMajor::where('hegis_code', $hegisCode)
                                                ->where('university_id', $universityId)->get();
                                                // ->where('university_major',$major)
                                                // ->first(['id']);
        return $universityMajorId->id;
    }

    public function getFREData($request) 
    {
        $data = UniversityMajor::where('hegis_code', $request->major)
            ->where('university_id', $request->university)
            ->with(['studentBackground' => function($query) use($request){
                $query->where('age_range_id', $request->age_range);
                $query->where('education_level', $request->education_level);
            },'studentBackground.investment' => function ($query) use ($request){
                $query->where('annual_earnings_id', $request->annual_earnings);
                $query->where('annual_financial_aid_id', $request->financial_aid);
            }])->firstOrFail();
        $freData = $data->studentBackground->first()->investment->first()->toArray();
        return $freData;
    }

    public function getPotentialNumberOfStudents($uid,$student_path, $entry_status)
    {
        $query = MajorPath::where('student_path',$student_path)
            ->where('university_majors_id',$uid)
            ->where('entry_status',$entry_status)
            ->firstOrFail();
        return $query;
    }

}