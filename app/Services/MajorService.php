<?php

namespace App\Services;

use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\MajorPath;
use App\Models\UniversityMajor;
use App\Contracts\MajorContract;
use Illuminate\Pagination\Paginator;

class MajorService implements MajorContract
{
    public function getAllHegisCodes(): array 
    {
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

    public function getHegisCategories($fieldOfStudyId): array
    {
        $fieldOfStudy = FieldOfStudy::with('hegisCategory')->with('hegisCategory.hegisCode')
                                    ->where('id', $fieldOfStudyId)->first();
        return $hegisCategory = $fieldOfStudy->hegisCategory->toArray();
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
}