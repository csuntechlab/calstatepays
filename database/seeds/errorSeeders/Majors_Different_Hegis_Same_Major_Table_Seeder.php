<?php

use Illuminate\Database\Seeder;

use App\Models\UniversityMajorsErrors;

class Majors_Different_Hegis_Same_Major_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/majors_different_hegis_same_major.json");
        $data = json_decode($json);

        foreach ($data as $row) {
            $universityMajor = new UniversityMajorsErrors();
            $universityMajor->hegis_code = $row->hegis_codes;
            $universityMajor->university_id = $row->university_id;
            $universityMajor->major = $row->major;
            $universityMajor->entry_status = $row->entry_stat;
            $universityMajor->student_path = $row->student_path;
            $universityMajor->id = $row->id;
            $universityMajor->save();
        }
    }
}
