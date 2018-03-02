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
        $json = File::get("database/data/naics_titles.json");
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('naics_titles')->insert([
                'naics_code'  => $row->naics_code,
                'naics_title' => $row->naics_title
            ]);
        };
    }
}
