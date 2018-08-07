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
        $json = File::get("database/data/master_industry_page_data.json");
        $data = json_decode($json);
        $majorService = new MajorService();

        // dd($data);
        foreach($data as $row){
            $industryPathType = new IndustryPathType();
            $industryWage = new IndustryWage();

            // dd($row);

            $university_major_id = $majorService->getUniversityMajorId($row->hegis_at_exit, $row->campus);

            if($row->naics != null){
                $industryPathType->entry_status = $row->entry_status;
                $industryPathType->naics_code = $row->naics;
                $industryPathType->student_path = $row->student_path;
                $industryPathType->population_sample_id = 1;
                $industryPathType->university_majors_id = $university_major_id;
                $industryPathType->save();

                $industryWage->id  = $industryPathType->id;
                $industryWage->avg_annual_wage_5 = $row->average_annual_earnings_5_years_after_exit;
                $industryWage->avg_annual_wage_10 = null;
                $industryWage->save();
            }
            

            
        }
    }
}
