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
        $allHegisCodes =  UniversityMajor::where('university_id', $universityId)
                                            ->get()
                                            ->map(function ($item){
            return [
                'hegis_code' => $item['hegis_code'],
                'major' => $item['major'],
                'university_id' => $item['university']->id
            ];
    
            });
        return $allHegisCodes->toArray();
        // dd($allHegisCodes);                                            
       $allHegisCodes = HEGISCode::orderBy('major', 'asc')->get()->unique()->map(function ($item){
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
        $fieldOfStudies = FieldOfStudy::orderBy('name', 'asc')->get();
        return $fieldOfStudies->toArray();
    }

    public function getHegisCategories($universityId,$fieldOfStudyId): array
    {
        /**
         * hegisCategory.hegisCode returns all the hegis codes associated with the hegis category_id,
         *  however once joined with university majors, all the hegis codes are mapped with hegis codes with in 
         * university's majors id with university_id, however not all hegis codes are offered at every campus 
         * so only some of the hegis codes have a corresponding university_majors relationship; otherwise it is null. 
         */
        $fieldOfStudy = FieldOfStudy::with( ['hegisCategory.hegisCode.universityMajors' => function ($query) use ($universityId) {
                                $query->where('university_id',$universityId);  
                                }])
                                ->where('id', $fieldOfStudyId)
                                ->first();
        $hegisCategory = $fieldOfStudy->hegisCategory;
        
        //TODO:Make its own function?
        /**
         * since $fieldOfStudy is separated by hegis category 
         * the following function lumps all the hegis codes in one array
         */
        foreach($hegisCategory as $category){
            $hegisCodes = $category['hegisCode'];
            $hegisData[] = $hegisCodes->toArray();
        }    
        $hegisData = array_collapse($hegisData); 
        
        //TODO:Make its own function?
        /**
         * Since this is filtered by university_id meaning 
         * not all hegis codes are offered at every campus.
         * This removes all the null values
         */
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
                            ->where('university_id', $university_id)
                            ->with('majorPaths.majorPathWage')
                            ->first()->majorPaths->toArray();
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

    public function getUniversityMajorId($hegisCode, $universityId)
    {
        $universityMajorId = UniversityMajor::where('hegis_code', $hegisCode)
                                                ->where('university_id', $universityId)
                                                ->first(['id']);
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
            ->first();
        return $query;
    }

    public function getAllUniversities() {
        $data = University::all()->toArray();
        return $data;
    }
}