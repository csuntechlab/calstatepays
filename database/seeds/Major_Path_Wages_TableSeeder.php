<?php

use Illuminate\Database\Seeder;

class Major_Path_Wages_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/major_path_wages.json");
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('major_path_wages')->insert([
                'major_path_id'            => $row->major_path_id,
                'avg_annual_wage'    => $row->avg_annual_wage,
                '25th'    => $row->_25th,
                '50th' => $row->_50th,
                '75th' => $row->_75th,
                'population_sample_id' => $row->population_sample_id
            ]);
        };
    }
}
