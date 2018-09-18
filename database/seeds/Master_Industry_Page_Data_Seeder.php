<?php

use Illuminate\Database\Seeder;
use App\Models\StudentBackground;
use App\Models\Investment;
use App\Models\MajorPath;
use App\Models\UniversityMajor;
use App\Services\MajorService;
use App\Models\Population;
use App\Models\IndustryPathType;
use App\Models\IndustryWage;
use App\Models\NaicsTitle;
use Faker\Factory as Faker;
class Master_Industry_Page_Data_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $json = File::get('database/data/master_industry_industry_path.json');
        $industry_path = json_decode($json);
        foreach($industry_path as $row)
        {
            $industryPathType = new IndustryPathType();
            $industryPathType->id  = $industryPathType->id;
            $industryPathType->entry_status = $row->entry_status;
            $industryPathType->naics_code = $row->naics_codes;
            $industryPathType->student_path = $row->student_path;
            $industryPathType->population_sample_id = 0;
            $industryPathType->university_majors_id = $row->university_majors_id;
            $industryPathType->save();
        }         
    }
}
