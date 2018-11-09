<?php

use Illuminate\Database\Seeder;
use App\Models\IndustryPathType;

class Los_Angeles_Industry_Path_Types_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/industryPathTypesData/Industry_Path_Types_los_angeles.json');
        $industry_path = json_decode($json);

        foreach ($industry_path as $row) {
            $industryPathType = new IndustryPathType();
            $industryPathType->id = $row->id;
            $industryPathType->entry_status = $row->entry_status;
            $industryPathType->naics_code = $row->naics_codes;
            $industryPathType->student_path = $row->student_path;
            $industryPathType->population_sample_id = $row->population_sample_id;
            $industryPathType->university_majors_id = $row->university_majors_id;
            $industryPathType->save();
        }
    }
}
