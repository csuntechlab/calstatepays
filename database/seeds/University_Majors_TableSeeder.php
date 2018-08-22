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

        foreach ($jsonCollection as $json ){
            $data = json_decode($json);
            $index = 1;
            foreach($data as $row){
                $universityMajor = new UniversityMajor();
                $universityMajor->hegis_code = $row->hegis_code;
                $universityMajor->university_id = $northridgeUniversityCode;
                $universityMajor->save();
            }
        }
    }
}
