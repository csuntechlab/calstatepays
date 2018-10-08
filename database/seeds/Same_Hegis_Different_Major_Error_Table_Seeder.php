<?php

use Illuminate\Database\Seeder;
use App\Models\SameHegisDifferentMajorError;

class Same_Hegis_Different_Major_Error_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/master_duplicate_hegis_code_different_major_table.json");
        $data = json_decode($json);

        // dd($data);

        foreach($data as $row) {
            $universityMajor = new SameHegisDifferentMajorError();
            $universityMajor->hegis_code = $row->hegis_codes;
            $universityMajor->university_id = $row->university_id;
            $universityMajor->major = $row->major;
            // $universityMajor->entry_status = $row->entry_status;
            // $universityMajor->student_path = $row->student_path;
            $universityMajor->id = $row->id;
            $universityMajor->save();
        }
    }
}
