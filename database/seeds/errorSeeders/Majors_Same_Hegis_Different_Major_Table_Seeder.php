<?php

use Illuminate\Database\Seeder;
use App\Models\SameHegisDifferentMajorError;

class Majors_Same_Hegis_Different_Major_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/errors/majors_same_hegis_different_major.json");
        $data = json_decode($json);

        foreach ($data as $row) {
            $universityMajor = new SameHegisDifferentMajorError();
            $universityMajor->hegis_code = $row->hegis_at_exit;
            $universityMajor->university_id = $row->campus;
            $universityMajor->major = $row->major;
            $universityMajor->entry_status = $row->entry_stat;
            $universityMajor->student_path = $row->student_path;
            $universityMajor->id = $row->id;
            $universityMajor->save();
        }
    }
}
