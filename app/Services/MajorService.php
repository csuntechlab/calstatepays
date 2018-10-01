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
    public function getAllHegisCodesByUniversity( $university_name ): array 
    {
        // $allHegisCodes = UniversityMajor::where('university_name', $university_major)
        //                     ->with(['university' => function($query) {
        //                         $query->where('opt_in',1);
        //                     }])
        //                     ->orderBy('major','asc')
        //                     ->get();
        
        /** 
         *  What is front end sending me?
         *  Passing in a university name from the link... Probably Short Name?
         *  Need to figure out how
         *  > Get UniversityId
         *  > Use that id, get the hegis codes
         */
        $allHegisCodes = University::where('short_name', $university_name)
                                            ->where('opt_in',1)
                                            ->with(['universityMajors' => function($query) {
                                                $query->orderBy('major','asc');
                                            }])
                                            ->get();
            
        // Given the situation where the CSU Opts out
        // TODO: MUST CHECK WITH FRONT END HOW TO DEAL WITH NULL
        if(!isset($allHegisCodes))
        {
            return [null];
        }
        // return $allHegisCodes->universityMajors->toArray();


        $allHegisCodes = $allHegisCodes[0]->universityMajors
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

    /** $universityId -> $universityName */
    public function getHegisCategories($universityName,$fieldOfStudyId): array
    {
        /** 
         * This might be a bad idea
         * But its the easiest approach to attain uni id
         */
        $universityId = University::where('short_name',$universityName)
                                    ->where('opt_in',1)
                                    ->firstOrFail();

        $universityId = $universityId->id;
        $fieldOfStudy = FieldOfStudy::with( ['hegisCategory.hegisCode.universityMajors' => function ($query) use ($universityId) {
                                $query->where('university_id',$universityId);  
                                }])
                                ->where('id', $fieldOfStudyId)
                                ->first();
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
    
    /**
     * $university_id -> $university_name
     */
    public function getMajorEarnings($hegis_code, $university_name): array
    {
        // $universityMajor = UniversityMajor::where('hegis_code', $hegis_code)
                            // ->with(['university' => function($query) {
                            //     $query->where('opt_in',1);
                            // }])
                            // ->where('university_id', $university_id)
                            // ->with('majorPaths.majorPathWage')
                            // ->first();

        $universityMajor = University::where('short_name', $university_name)
                            ->where('opt_in',1)
                            ->with(['universityMajors' => function($query) use ($hegis_code) {
                                $query->where('hegis_code',$hegis_code);
                            }, 'universityMajors.majorPaths.majorPathWage'])
                            ->first();

        // situation where CSU opts out
        // Might want to refactor this method?
        if(!isset($universityMajor))
        {
            return [];
        }
                            
        if ( empty($universityMajor) ){
            return [];
        }
        // else if ( empty($universityMajor->majorPaths) ){
        //     return [];
        // }
        else if ( empty($universityMajor->universityMajors[0]->majorPaths) ){
            return [];
        }

        // $universityMajor = $universityMajor->majorPaths->toArray();  
        $universityMajor = $universityMajor->universityMajors[0]->majorPaths->toArray();                   
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

    /**
     *  How do?
     */
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
            ->first();
        return $query;
    }

}