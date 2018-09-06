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

        $json = File::get("database/data/channel_islands_majors_path_wages.json");
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

        /**
         * Try to figure out a way in python such that we can make a master major path wage table?
         *  The issue was that when we query
         *  http://127.0.0.1:8000/api/major/5131/10
         *  the way our code works, it wants to find the register/address of 29011
         *  and our major_path_id weren't adding up to a summation
         *  for example pomona only goes from major_path_id 1 to 9k (in the json)
         *  it would be impossible to even hit that
         *  so the solution is to make the json auto increment for major_path_id
         *  We can probably do this in python no problem
         */

        $i = 1;

        foreach ($jsonCollection as $json ){
            $data = json_decode($json);

            foreach($data as $row){
                $i++;
                $majorPathWage = new MajorPathWage();

                $majorPathWage->major_path_id = $i;
                $majorPathWage->_25th = $row->_25th_percentile_earnings;
                $majorPathWage->_50th = $row->_50th_percentile_earnings;
                $majorPathWage->_75th = $row->_75th_percentile_earnings;
                $majorPathWage->save();
            }
        }
    }
}
