<?php

use Illuminate\Database\Seeder;
use App\Models\MajorPathWage;
use App\Models\Population;

class Major_Paths_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/major_paths.json");
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('major_paths')->insert([
                'id'                   => $row->id,
                'student_path'         => $row->student_path,
                'university_majors_id' => $row->university_majors_id,
                'entry_status'         => $row->entry_status,
                'years'                => $row->years
            ]);
            // Creating a row for each table in the for loop allows relationship id's to reference eachother
            factory(MajorPathWage::class)->create(['major_path_id'=> $row->id, 'population_sample_id' => $row->id]);
            factory(Population::class)->create(['id' => $row->id]);
        };
    }
}
