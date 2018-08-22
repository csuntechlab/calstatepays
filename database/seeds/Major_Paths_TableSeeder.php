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
        $jsonCollection = array();
        $json = File::get("database/data/northridge_majors_path.json");
        array_push($jsonCollection,$json);

        foreach ($jsonCollection as $json ){
            $data = json_decode($json);

            foreach($data as $row){
                
                $majorPath = new MajorPath();
                
                $majorPath->student_path = $row->student_path;
                $majorPath->entry_status = $row->entry_status;
                $majorPath->years = $row->year;
                $majorPath->university_majors_id = $row->university_majors_id;
                $majorPath->save();

            }
        }
    }
}
