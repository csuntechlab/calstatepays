<?php

use Illuminate\Database\Seeder;

class University_Majors_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/university_majors.json");
        $data = json_decode($json);

        //Data for Student_Background table
        $education_level = ['FTT', 'FTF'];
        foreach($data as $row){
            DB::table('university_majors')->insert([
                'id'            => $row->id,
                'hegis_code'    => $row->hegis_code,
                'college_id'    => $row->college_id,
                'university_id' => $row-> university_id
            ]);


        };
    }
}
