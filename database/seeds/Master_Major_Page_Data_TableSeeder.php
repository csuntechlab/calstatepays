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
        $faker = Faker::create();
        foreach($data as $row){
            $universityMajor = new UniversityMajor();
            $majorPath       = new MajorPath();
            $majorPathWage   = new MajorPathWage();
            $population      = new Population();

            $universityMajor->university_id = $row->campus;
            $hegis_code = $majorService->getHegisCode($row->major_at_exit);
            $universityMajor->hegis_code = $hegis_code['hegis_code'];
            $universityMajor->save();

            $majorPath->university_majors_id = $universityMajor->id;
            $majorPath->entry_status = $row->entry_stat;
            $majorPath->years = $row->year;
            $majorPath->student_path = $row->student_path;
            $majorPath->save();

            $population->population_found = $row->number_of_students_found;
            $population->population_size = $row->potential_number_of_students_for_each_year_out_of_school;
            $population->percentage_found = $faker->randomFloat(null,1,23);
            $population->save();

            $majorPathWage->major_path_id = $majorPath->id;
            $majorPathWage->_25th = $row->_25th_percentile_earnings;
            $majorPathWage->_50th = $row->_50th_percentile_earnings;
            $majorPathWage->_75th = $row->_75th_percentile_earnings;
            $majorPathWage->population_sample_id = $population->id;
        };
    }
}
