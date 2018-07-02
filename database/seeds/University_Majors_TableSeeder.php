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
        $json = File::get('database/data/northridge_hegis_codes.json');
        $data = json_decode($json);
        $northridgeUniversityCode = 70;
        foreach($data as $row){
            $universityMajor = new UniversityMajor();
            $universityMajor->hegis_code = $row->hegis_code;
            $universityMajor->university_id = $northridgeUniversityCode;
            $universityMajor->save();


        }
    }
}
