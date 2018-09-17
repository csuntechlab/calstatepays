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

        // naics titles...
        $industry = File::get('database/data/master_naics_titles.json');
        $data = json_decode($industry);

        foreach($data as $row)
        {
            $naics = new NaicsTitle();
            $naics->naics_code = $row->id;
            $naics->naics_title = $row->industry;
            $naics->image = $row->image;
            $naics->save();
        }
        
        $industry_path_wages = glob('database/data/*_industry_path_wages.json');   
        foreach ($industry_path_wages as $industry_path_wage)
        {
            $json = File::get($industry_path_wage);
            $data = json_decode($json);

            foreach($data as $row)
            {
                $industryWage = new IndustryWage();
                $industryWage->id  = $row->id;
                $industryWage->avg_annual_wage_5 = $row->avg_annual_wage_5;  
                $industryWage->save();
            }          
        }

        $industry_paths = glob('database/data/*_industry_path.json');
        foreach ($industry_paths as $industry_path)
        {
            $json = File::get($industry_path);
            $data = json_decode($json);

            foreach($data as $row)
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

        // $json = File::get("database/data/master_industry_page_data.json");
        // $data = json_decode($json);
        // $majorService = new MajorService();

        // foreach($data as $row){
        //     $industryPathType = new IndustryPathType();
        //     $industryWage = new IndustryWage();
        //     $population = new Population();
        //     // $potential_number_of_students = $majorService->getPotentialNumberOfStudents($university_major_id, $row->student_path, $row->entry_status)->potential_number_of_students;

        //     $potential_number_of_students = 1;

        //     if($row->naics != null){
        //         $hegis_code = $row->hegis_at_exit;

        //         // var_dump($row);

        //         $university_major_id = $majorService->getUniversityMajorId($row->hegis_at_exit, $row->campus, $row->major );
        //         var_dump($university_major_id);
                
        //         $majorPath = new MajorPath();

        //         $population->population_found = $row->number_of_students_found_5_years_after_exit;
        //         $population->population_size = $potential_number_of_students;
        //         $population->universityId = $university_major_id;
        //         $population->naics = $row->naics;
        //         if($population->population_found != null && $population->population_size != null)
        //         {
        //             $population->percentage_found = 100 * ($population->population_found / $population->population_size);
        //         }
        //         $population->save();

        //         $industryPathType->entry_status = $row->entry_status;
        //         $industryPathType->naics_code = $row->naics;
        //         $industryPathType->student_path = $row->student_path;
        //         $industryPathType->population_sample_id = $population->id;
        //         $industryPathType->university_majors_id = $university_major_id;
        //         $industryPathType->save();

        //         $industryWage->id  = $industryPathType->id;
        //         $industryWage->avg_annual_wage_5 = $row->average_annual_earnings_5_years_after_exit;
        //         $industryWage->avg_annual_wage_10 = null;
        //         $industryWage->save();


        //     }
        // }
    }
}
