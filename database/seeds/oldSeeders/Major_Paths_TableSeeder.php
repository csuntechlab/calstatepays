<?php

use Illuminate\Database\Seeder;

use App\Models\MajorPath;


class Major_Paths_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $jsonCollection = array();
        $json = File::get("database/data/master_majors_path_table.json");
        $data = json_decode($json);
        
        foreach($data as $row){
            
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
