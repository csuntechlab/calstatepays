<?php

use Illuminate\Database\Seeder;

use App\Models\Aggregate_different_hegis_same_major;

class Aggregate_different_hegis_same_majors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/aggregate_different_hegis_same_major.json");
        $data = json_decode($json);

        foreach($data as $row) {
            $universityMajor = new Aggregate_different_hegis_same_major();
            $universityMajor->hegis_code = $row->hegis_at_exit;
            $universityMajor->university = "All";
            $universityMajor->major = $row->majors;
            $universityMajor->id = $row->id;
            $universityMajor->save();
        }
    }
}
