<?php

use Illuminate\Database\Seeder;
use App\Models\UniversityMajor;

class Los_Angeles_University_Majors_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/universityMajorData/los_angeles_university_majors_table.json");
        $data = json_decode($json);

        foreach ($data as $row) {
            $universityMajor = new UniversityMajor();
            $universityMajor->hegis_code = $row->hegis_codes;
            $universityMajor->university_id = $row->campus;
            $universityMajor->major = $row->major;
            $universityMajor->id = $row->id;
            $universityMajor->save();
        }
    }
}
