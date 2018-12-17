<?php

use Illuminate\Database\Seeder;

use App\Models\StudentBackground;

class Student_Backgrounds_Template_Northridge_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/sample_northridge_PFRE.json');
        // do not delete
        // $json = File::get('database/data/studentBackgroundData/Student_Background_northridge.json');
        $industry_path = json_decode($json);

        foreach ($industry_path as $row) {
            $studentBackground = new StudentBackground();
            $studentBackground->id = $row->student_background_id;
            $studentBackground->university_major_id = $row->university_majors_id;
            $studentBackground->age_range_id = $row->age_range_id;
            $studentBackground->education_level = $row->entry_stat;
            $studentBackground->annual_earnings_id = $row->annual_earnings_during_school_id; // during school
            $studentBackground->annual_financial_aid_id = $row->annual_financial_aid_id;
            $studentBackground->save();
        }
    }
}
