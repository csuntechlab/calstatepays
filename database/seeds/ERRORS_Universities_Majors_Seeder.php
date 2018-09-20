<?php

use Illuminate\Database\Seeder;

use App\Models\UniversityMajorsErrors;

class ERRORS_Universities_Majors_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/master_errors_table.json");
        $data = json_decode($json);

        foreach($data as $row) {
            $universityMajor = new UniversityMajorsErrors();
            $universityMajor->hegis_code = $row->hegis_codes;
            $universityMajor->university_id = $row->university_id;
            $universityMajor->major = $row->major;
            $universityMajor->id = $row->id;
            $universityMajor->save();
        }
    }
}
