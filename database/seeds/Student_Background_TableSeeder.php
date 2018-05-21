<?php

use Illuminate\Database\Seeder;
use App\Models\StudentBackground;

class Student_Background_TableSeeder extends Seeder
{

    public function run()
    {
        $earnings = [
            'age_range_id' => [
                0,1,2,3,4
            ],
            'age_range_name' => [
                '0',
                '0 - 20000',
                '20000 - 45000',
                '45000 - 60000',
                '60000 - 90000'
            ]
        ];
        for($i = 0;$i < 5;$i++){
            $education_level = ['FTT', 'FTF'];
            factory(StudentBackground::class)->create([
                'age_range_id'    => $earnings['age_range_id'][$i],
                'age_range_name'  => $earnings['age_range_name'][$i],
                'education_level' => $education_level[0]
            ])->each(

            );
            factory(StudentBackground::class)->create([
                'age_range_id'    => $earnings['age_range_id'][$i],
                'age_range_name'  => $earnings['age_range_name'][$i],
                'education_level' => $education_level[1]
            ])->each(

            );
        }
    }
}
