<?php

use Illuminate\Database\Seeder;
use App\Models\MajorPath;

class MajorPath_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/master_major_page_data.json");
        $data = json_decode($json);
        foreach($data as $row)
        {
            $majorPath = new MajorPath();
    
            $majorPath->university_majors_id = $row->campus;
            $majorPath->entry_status = $row->entry_status;
            $majorPath->years = $row->year;
            $majorPath->student_path = $row->student_path;
            $majorPath->save();
        }
    }
}
