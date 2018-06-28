<?php

use Illuminate\Database\Seeder;

class Student_Paths_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/student_paths.json');
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('student_paths')->insert([
                'id'        => $row->id,
                'path_name' => $row->path_name
            ]);
        }
    }
}
