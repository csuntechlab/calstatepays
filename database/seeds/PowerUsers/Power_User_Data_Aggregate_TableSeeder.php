<?php

use Illuminate\Database\Seeder;

class Power_User_Data_Aggregate_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/powerUserData/Power_User_Data_Aggregate.json");
        $data = json_decode($json);
        foreach ($data as $row) {
            DB::table('power_users_data')->insert([
                'university_id' => $row->university_id,
                'path_id' => $row->path_id,
                'iframe_server' => $row->iframe_server,
                'iframe_string' => $row->iframe_string,
                'opt_in' => $row->opt_in
            ]);
        };
    }
}
