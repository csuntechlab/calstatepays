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
        $json = File::get("database/data/master_naics_titles.json");
        $data = json_decode($json);
        foreach($data as $row){
            if($row->id !=null){
                DB::table('naics_titles')->insert([
                    'image'       => $row->image,
                    'naics_code'  => $row->id,
                    'naics_title' => $row->industry
                    
                ]);
            }
        };
    }
}
