<?php

use Illuminate\Database\Seeder;

class Major_Paths_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/major_paths.json");
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('major_paths')->insert([
                'id'                   => $row->id,
                'student_path'         => $row->student_path,
                'university_majors_id' => $row->university_majors_id,
                'entry_status'         => $row->entry_status,
                'years'                => $row->years
            ]);
        };
    }
}
