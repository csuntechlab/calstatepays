<?php

use Illuminate\Database\Seeder;

class Power_User_Data_Long_Beach_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/powerUserData/Power_User_Data_Long_Beach.json");
        $data = json_decode($json);
        foreach ($data as $row) {
            DB::table('power_users_data')->insert([
                'university_id' => $row->university_id,
                'path_id' => $row->path_id,
                'iFramePathString' => $row->iFramePath,
            ]);
        };
    }
}
