<?php

use Illuminate\Database\Seeder;
use App\Models\StudentBackground;
use App\Models\Investment;

class Student_Background_TableSeeder extends Seeder
{

    public function run()
    {
        $age_range_id_array           = [ 1, 2, 3, 4];
        $anual_income_and_tuition_id  = [ 1, 2, 3, 4];

        for($i = 0;$i < 4;$i++){
            $education_level = ['FTT', 'FTF'];
            factory(Investment::class)->create([
                'annual_earnings_id'      => $annual_income_and_tuition_id[$i],
                'annual_financial_aid_id' => 0
            ])->each();/*factory(StudentBackground::class)->create([
                'age_range_id'    => $age_range_id_array[$i],
                'education_level' => $education_level[0],
            ]);
            factory(StudentBackground::class)->create([
                'age_range_id'    => $age_range_id_array[$i],
                'education_level' => $education_level[1],
            ]);*/
        }
    }
}
