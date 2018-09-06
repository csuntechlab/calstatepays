<?php

use Illuminate\Database\Seeder;

use App\Models\MajorPathWage;

class Major_Path_Wages_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonCollection = array();
        $json = File::get("database/data/northridge_majors_path_wages.json");
        array_push($jsonCollection,$json);

        $json = File::get("database/data/channel_island_majors_path_wages.json");
        array_push($jsonCollection,$json);

//        $json = File::get("database/data/dominguez_hills_majors_path_wages.json");
//        array_push($jsonCollection,$json);

        $json = File::get("database/data/fullerton_majors_path_wages.json");
        array_push($jsonCollection,$json);
        
        $json = File::get("database/data/los_angeles_majors_path_wages.json");
        array_push($jsonCollection,$json);
        
        $json = File::get("database/data/pomona_majors_path_wages.json");
        array_push($jsonCollection,$json);

        // $json = File::get("database/data/long_beach_majors_path_wages.json");
        // array_push($jsonCollection,$json);

        foreach ($jsonCollection as $json ){
            $data = json_decode($json);

            foreach($data as $row){
                $majorPathWage = new MajorPathWage();

                $majorPathWage->major_path_id = $row->major_path_id;
                $majorPathWage->_25th = $row->_25th_percentile_earnings;
                $majorPathWage->_50th = $row->_50th_percentile_earnings;
                $majorPathWage->_75th = $row->_75th_percentile_earnings;
                $majorPathWage->save();
            }
        }
    }
}
