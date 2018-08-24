<?php

use Illuminate\Database\Seeder;
use App\Models\UniversityMajor;

class University_Majors_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonCollection = array();
        $json = File::get("database/data/northridge_university_majors_id.json");
        array_push($jsonCollection,$json);

        $json = File::get("database/data/channel_islands_university_majors_id.json");
        array_push($jsonCollection,$json);

        $json = File::get("database/data/dominguez_hills_university_majors_id.json");
        array_push($jsonCollection,$json);

        $json = File::get("database/data/fullerton_university_majors_id.json");
        array_push($jsonCollection,$json);
        
        $json = File::get("database/data/los_angeles_university_majors_id.json");
        array_push($jsonCollection,$json);
        
        $json = File::get("database/data/pomona_university_majors_id.json");
        array_push($jsonCollection,$json);

        // $json = File::get("database/data/long_beach_university_majors_id.json");
        // array_push($jsonCollection,$json);

        foreach ($jsonCollection as $json ){
            $data = json_decode($json);
            $index = 1;
            // var_dump($data);
            foreach($data as $row){
                $universityMajor = new UniversityMajor();
                $universityMajor->hegis_code = $row->hegis_codes;
                $universityMajor->university_id = $row->university_id;
                $universityMajor->id = $row->id;
                $universityMajor->save();
            }
        }
    }
}
