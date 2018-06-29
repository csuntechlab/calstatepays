<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Universities_Test_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/universities_test.json");
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('universities')->insert([
                'id'              => $row->id,
                'university_name' => $row->university
            ]);
        };
    }
}
