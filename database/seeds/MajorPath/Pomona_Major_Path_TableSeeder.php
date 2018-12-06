<?php

use Illuminate\Database\Seeder;
use App\Models\MajorPath;

class Pomona_Major_Path_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/majorPathData/Major_Path_pomona.json");
        $data = json_decode($json);

        foreach ($data as $row) {
            $majorPath = new MajorPath();
            $majorPath->id = $row->id;
            $majorPath->student_path = $row->student_path;
            $majorPath->entry_status = $row->entry_status;
            $majorPath->years = $row->year;
            $majorPath->university_majors_id = $row->university_majors_id;
            $majorPath->save();
        }
    }
}
