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

        foreach($data as $row){
            $industryPathType = new IndustryPathType();
            $industryWage = new IndustryWage();
            $population = new Population();

            $university_major_id = $majorService->getUniversityMajorId($row->hegis_at_exit, $row->campus);
            $sample = $majorService->getPotentialNumberOfStudents($university_major_id, $row->student_path, $row->entry_status);

            if($row->naics != null){

                $hegis_code = $row->hegis_at_exit;
                $universityId = $majorService->getUniversityMajorId($row->hegis_at_exit, $row->campus);
                $majorPath = new MajorPath();

                $population->population_found = $row->number_of_students_found_5_years_after_exit;
                $population->population_size = $sample;
                if($population->population_found != null && $population->population_size != null)
                {
                    $population->percentage_found = $population->population_found / $population->population_size;
                }

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
