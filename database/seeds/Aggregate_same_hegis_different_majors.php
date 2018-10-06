<?php

use Illuminate\Database\Seeder;
use App\Models\Aggregate_same_hegis_different_major;

class Aggregate_same_hegis_different_majors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/aggregate_same_hegis_different_major.json");
        $data = json_decode($json);

        foreach($data as $row) {
            $universityMajor = new Aggregate_same_hegis_different_major();
            $universityMajor->hegis_code = $row->hegis_at_exit;
            $universityMajor->university = "All";
            $universityMajor->major = $row->majors;
            $universityMajor->entry_status = $row->entry_status;
            $universityMajor->student_path = $row->student_path;
            $universityMajor->id = $row->id;
            $universityMajor->save();
        }
    }
}
