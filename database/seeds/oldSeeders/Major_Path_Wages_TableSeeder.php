<?php

use Illuminate\Database\Seeder;

use App\Models\MajorPathWage;

class Major_Path_Wages_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/master_majors_path_wage_table.json");
        $data = json_decode($json);

        foreach ($data as $row) {
            $majorPathWage = new MajorPathWage();

            $majorPathWage->major_path_id = $row->major_path_id;
            $majorPathWage->_25th = $row->_25th_percentile_earnings;
            $majorPathWage->_50th = $row->_50th_percentile_earnings;
            $majorPathWage->_75th = $row->_75th_percentile_earnings;
            $majorPathWage->save();
        }

    }
}
