<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Naics_Titles_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/naics_titles_data.json");
        $data = json_decode($json);
        foreach($data as $row){
            if($row->naics_code !=null){
                DB::table('naics_titles')->insert([
                    'image'       => $row->image,
                    'naics_code'  => $row->naics_code,
                    'naics_title' => $row->naics_title
                    
                ]);
            }
        };
    }
}
