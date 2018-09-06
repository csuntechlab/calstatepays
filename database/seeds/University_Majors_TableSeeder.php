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
        $json = File::get("database/data/master_university_table.json");
        $data = json_decode($json);
        // var_dump($json);
                
        // $json = File::get("database/data/long_beach_university_majors_id.json");
        // array_push($jsonCollection,$json);

        foreach($data as $row) {

            $universityMajor = new UniversityMajor();
            $universityMajor->hegis_code = $row->hegis_codes;
            $universityMajor->university_id = $row->university_id;
            $universityMajor->major = $row->major;
            $universityMajor->id = $row->id;
            $universityMajor->save();
        }
        
    }
}
