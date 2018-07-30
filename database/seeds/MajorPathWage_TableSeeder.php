<?php

use Illuminate\Database\Seeder;
use App\Models\MajorPathWage;

class MajorPathWage_TableSeeder extends Seeder
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
        foreach($data as $key=>$row)
        {
            // dd($row);
            $majorPathWage = new MajorPathWage();
            
            $majorPathWage->major_path_id = $key;
            $majorPathWage->_25th = $row->_25th_percentile_earnings;
            $majorPathWage->_50th = $row->_50th_percentile_earnings;
            $majorPathWage->_75th = $row->_75th_percentile_earnings;
            $majorPathWage->population_sample_id = $key;
            $majorPathWage->save();
        }
    }
}
