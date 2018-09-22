<?php

use Illuminate\Database\Seeder;

use App\Models\industry_same_hegis_different_major;

class Industry_Same_Hegis_Different_Majors_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/industry_same_hegis_different_major.json");
        $data = json_decode($json);

        foreach($data as $row) {
            $industry_same_hegis_different_major = new industry_same_hegis_different_major();
            $industry_same_hegis_different_major->hegis_code = $row->hegis_at_exit;
            $industry_same_hegis_different_major->university_id = $row->campus;
            $industry_same_hegis_different_major->major = $row->major;
            $industry_same_hegis_different_major->id = $row->id;
            $industry_same_hegis_different_major->save();
        }
    }
}
