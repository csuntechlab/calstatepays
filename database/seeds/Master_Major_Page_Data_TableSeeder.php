<?php

use Illuminate\Database\Seeder;
use App\Models\UniversityMajor;
use App\Models\MajorPath;
use App\Models\MajorPathWage;
use App\Models\Population;
use App\Services\MajorService;
use Faker\Factory as Faker;

class Master_Major_Page_Data_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/master_major_page_data.json");
        $data = json_decode($json);
        $majorService = new majorService();
        foreach($data as $row){
            
            $majorPath = new MajorPath();
            $majorPathWage = new MajorPathWage();

            $hegis_code = $row->hegis_at_exit;
            $universityId = $majorService->getUniversityMajorId($hegis_code, $row->campus);
            
            $majorPath->university_majors_id = $universityId;
            $majorPath->entry_status = $row->entry_status;
            $majorPath->years = $row->year;
            $majorPath->student_path = $row->student_path;
            $majorPath->potential_number_of_students  = $row->potential_number_of_students;
            $majorPath->save();

            $majorPathWage->major_path_id = $majorPath->id;
            $majorPathWage->_25th = $row->_25th_percentile_earnings;
            $majorPathWage->_50th = $row->_50th_percentile_earnings;
            $majorPathWage->_75th = $row->_75th_percentile_earnings;
            $majorPathWage->save();

        };
    }
}
