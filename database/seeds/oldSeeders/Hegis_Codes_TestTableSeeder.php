<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Hegis_Codes_TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/hegis_codes_test.json");
        $data = json_decode($json);
        foreach($data as $row){
                DB::table('hegis_codes')->insert([
                    'hegis_code' => $row->hegis_code,
                    'hegis_category_id' => $row->hegis_category_id,
                    'major'      => $row->major,
                ]);
        };
    }
}
