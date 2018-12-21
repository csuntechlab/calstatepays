<?php

use Illuminate\Database\Seeder;
use App\Models\PowerUserImage;

class Power_User_Card_Images_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/powerUserData/Power_User_Image_Landing_Page.json");
        $data = json_decode($json);

        foreach ($data as $row) {
            $powerUserImage = new PowerUserImage();
            $powerUserImage->id = $row->university_id;
            $powerUserImage->university = $row->university;
            $powerUserImage->card_image = $row->card_image;
            $powerUserImage->opt_in = $row->opt_in;
            $powerUserImage->save();
        }
    }
}
