<?php

use Illuminate\Database\Seeder;
use App\Models\UniversityMajor;
use App\Models\MajorPath;
use App\Models\MajorPathWage;
use App\Models\Population;
use App\Services\MajorService;

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
            $universityMajor = new UniversityMajor();
            $majorPath       = new MajorPath();
            $majorPathWage   = new MajorPathWage();
            $population      = new Population();

            $majorPath->entry_status = $row['entry_stat'];
            $majorPath->years = $row['year'];
            $majorPath->student_path = $row['student_path'];

            $majorPathWage->_25th = $row['25th_percentile_earnings'];
            $majorPathWage->_50th = $row['50th_percentile_earnings'];
            $majorPathWage->_75th = $row['75th_percentile_earnings'];

            $universityMajor->university_id = 
        };
    }
}
