<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Universities_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/universities.json");
        $data = json_decode($json);
        foreach ($data as $row) {
            DB::table('universities')->insert([
                'id' => $row->id,
                'university_name' => $row->university,
                'short_name' => $row->short_name,
                'acronym' => $row->acronym,
                'opt_in' => $row->opt_in
            ]);
        };
    }
}
