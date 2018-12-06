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
        $json = File::get('database/data/samplePFRE.json');
        // do not delete
        // $json = File::get('database/data/studentBackgroundData/Student_Background_northridge.json');
        $industry_path = json_decode($json);

        foreach ($industry_path as $row) {
            $studentBackground = new StudentBackground();
            $studentBackground->id = $row->id;
            $studentBackground->university_major_id = $row->campus;
            $studentBackground->age_range_id = $row->age_range;
            $studentBackground->education_level = $row->entry_stat;
            $studentBackground->save();
        }
    }
}
