<?php

use Illuminate\Database\Seeder;
use App\Models\StudentBackground;

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
        $education_levels = ['FTT', 'FTF'];
        $age_ranges = [
            [ 'age_range_id' => 1,'age_range_name' => '18 - 19'],
            [ 'age_range_id' => 2,'age_range_name' => '20 - 24'],
            [ 'age_range_id' => 3,'age_range_name' => '24 - 26'],
            [ 'age_range_id' => 4,'age_range_name' => '26 +']
        ];
        foreach($data as $row){
            DB::table('university_majors')->insert([
                'id'            => $row->id,
                'hegis_code'    => $row->hegis_code,
                'college_id'    => $row->college_id,
                'university_id' => $row-> university_id
            ]);

            foreach($age_ranges as $age_range){
                foreach($education_levels as $education_level){
                    factory(StudentBackground::class)->create([
                        'university_major_id' => $row->id,
                        'age_range_id' => $age_range['age_range_id'],
                        'age_range_name' => $age_range['age_range_name'],
                        'education_level_name' => $education_level
                    ]);
                }
            }

        };
    }
}
