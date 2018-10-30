<?php

use Illuminate\Database\Seeder;
use App\Models\IndustryDifferentHegisSameMajor;

class Industry_Different_Hegis_Same_Majors_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/errors/industry_different_hegis_same_major.json");
        $data = json_decode($json);

        foreach ($data as $row) {
            $IndustryDifferentHegisSameMajor = new IndustryDifferentHegisSameMajor();
            $IndustryDifferentHegisSameMajor->hegis_code = $row->hegis_at_exit;
            $IndustryDifferentHegisSameMajor->university_id = $row->campus;
            $IndustryDifferentHegisSameMajor->major = $row->major;
            $IndustryDifferentHegisSameMajor->entry_status = $row->entry_stat;
            $IndustryDifferentHegisSameMajor->student_path = $row->student_path;
            $IndustryDifferentHegisSameMajor->id = $row->id;
            $IndustryDifferentHegisSameMajor->save();
        }
    }
}
