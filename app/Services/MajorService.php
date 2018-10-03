<?php

namespace App\Services;

use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\MajorPath;
use App\Models\UniversityMajor;
use App\Models\University;
use App\Contracts\MajorContract;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MajorService implements MajorContract
{
    public function getAllHegisCodesByUniversity( $university_name ): array 
    {
        $allHegisCodes = University::where('short_name', $university_name)
                                            ->where('opt_in',1)
                                            ->with(['universityMajors' => function($query) {
                                                $query->orderBy('major','asc');
                                            }])
                                            ->get();
      
        // Given the situation where the CSU Opts out
        // TODO: MUST CHECK WITH FRONT END HOW TO DEAL WITH NULL
        if($allHegisCodes->isEmpty()){   
            $message = ''.$university_name.' was not found';
            throw new ModelNotFoundException($message,409);
        }


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

        if($fieldOfStudies->isEmpty()){   
            $message ='Field of Study table has no data';
            throw new ModelNotFoundException($message,409);
        }
        
        return $fieldOfStudies->toArray();
    }

    public function getHegisCategories($universityName,$fieldOfStudyId): array
    {
        $universityId = University::where('short_name',$universityName)
                                    ->where('opt_in',1)
                                    ->firstOrFail();

        $universityId = $universityId->id;
        $fieldOfStudy = FieldOfStudy::with( ['hegisCategory.hegisCode.universityMajors' => function ($query) use ($universityId) {
                                $query->where('university_id',$universityId);  
                                }])
                                ->where('id', $fieldOfStudyId)
                                ->firstOrFail();

        if ( empty($fieldOfStudy->hegisCategory) ){
            $message ='There is no hegis category that is mapped to this field of study';
            throw new ModelNotFoundException($message,409);
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
    
    public function getMajorEarnings($hegis_code, $university_name): array
    {
        $universityMajor = University::where('short_name', $university_name)
                            ->where('opt_in',1)
                            ->with(['universityMajors' => function($query) use ($hegis_code) {
                                $query->where('hegis_code',$hegis_code);
                            }, 'universityMajors.majorPaths.majorPathWage'])
                            ->firstOrFail();

        if($universityMajor->university_name == null){
            $message ='This university does not exist in the database';                  
            throw new ModelNotFoundException($message,409);
        }
        
        if (empty($universityMajor->universityMajors[0]->majorPaths)){
            $message ='Major paths data was not found';                  
            throw new ModelNotFoundException($message,409);
        }

        // $universityMajor = $universityMajor->majorPaths->toArray();  
        $universityMajor = $universityMajor->universityMajors[0]->majorPaths->toArray();                   
        return $universityMajor;
    }

    //TODO: Delete this method ? not Being used

    public function getHegisCode($name)
    {
        $hegis_code = HEGISCode::where('major', $name)
                                ->firstOrFail(['hegis_code']);
                                
        return $hegis_code;
    }

    public function getUniversityMajorId($hegisCode, $universityId, $major)
    {

        $universityMajorId = UniversityMajor::where('hegis_code', $hegisCode)
                                                ->where('university_id', $universityId)->get();
                                                // ->where('university_major',$major)
                                                // ->first(['id']);
        if(empty($universityMajorId)){
            $message ='University Major not found';                  
            throw new ModelNotFoundException($message,409);   
        }
        return $universityMajorId->id;
    }

    public function getFREData($request) 
    {
        /**
         * ugly bad easy way to go from uni_name -> uni_id
         */
        $university_id = University::where('short_name',$request->university)->firstorfail();

        $data = UniversityMajor::where('hegis_code', $request->major)
            ->where('university_id', $university_id->id)
            ->with(['studentBackground' => function($query) use($request){
                $query->where('age_range_id', $request->age_range);
                $query->where('education_level', $request->education_level);
            },'studentBackground.investment' => function ($query) use ($request){
                $query->where('annual_earnings_id', $request->annual_earnings);
                $query->where('annual_financial_aid_id', $request->financial_aid);
            }])->firstOrFail();

        $freData = $data->studentBackground->first();
        $freData= $freData->investment->first();
        if(empty($freData)){
            $message ='Investment not found';                  
            throw new ModelNotFoundException($message,409);
        }
        $freData = $freData->toArray();
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