<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Hegis_Codes_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/hegis_codes.json");
        $data = json_decode($json);
        foreach($data as $row){
                DB::table('hegis_codes')->insert([
                    'hegis_code' => $row->hegis_code,
                    'major'      => $row->major,
                    'university' => $row->university
                ]);
        };
    }
}