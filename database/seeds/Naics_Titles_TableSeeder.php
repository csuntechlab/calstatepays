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
        // dd($data);
        foreach($data as $row){
            // dd($row->naics_title);
            if($row->naics_codes !=null){
                DB::table('naics_titles')->insert([
                    'image'       => $row->image,
                    'naics_code'  => $row->naics_codes,
                    'naics_title' => $row->naics_title
                    
                ]);
            }
        };
    }
}
