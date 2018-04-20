<?php

use Illuminate\Database\Seeder;

class Industry_Path_Types_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/industry_path_types.json");
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('industry_path_types')->insert([
                'id'            => $row->id,
                'entry_status'    => $row->entry_status,
                'naics_code'    => $row->naics_code,
                'student_path' => $row->student_path,
                'population_sample_id' => $row->population_sample_id,
                'university_majors_id' => $row->university_majors_id
            ]);
        };
    }
}
