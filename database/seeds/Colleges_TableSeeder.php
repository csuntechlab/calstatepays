<?php

use Illuminate\Database\Seeder;

class Colleges_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/colleges.json");
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('colleges')->insert([
                'id'           => $row->id,
                'college_name' => $row->college_name
            ]);
        };
    }
}
