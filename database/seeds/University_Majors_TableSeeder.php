<?php

use Illuminate\Database\Seeder;
use App\Models\StudentBackground;
use App\Models\Investment;

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
        //Data for Investments table
        $annual_earnings = [
            [ 'annual_earnings_id' => 1,'annual_earnings_name' => '0'],
            [ 'annual_earnings_id' => 2,'annual_earnings_name' => '0 - 20,000'],
            [ 'annual_earnings_id' => 3,'annual_earnings_name' => '20,000 - 30,000'],
            [ 'annual_earnings_id' => 4,'annual_earnings_name' => '30,000 - 45,000'],
            [ 'annual_earnings_id' => 5,'annual_earnings_name' => '45,000 - 60,000'],
            [ 'annual_earnings_id' => 6,'annual_earnings_name' => '60,000 +'],
        ];
        $annual_financial_aid = [
            [ 'annual_financial_aid_id' => 1,'annual_financial_aid_name' => '0'],
            [ 'annual_financial_aid_id' => 2,'annual_financial_aid_name' => '0 - 5,000'],
            [ 'annual_financial_aid_id' => 3,'annual_financial_aid_name' => '5,000 - 15,000'],
            [ 'annual_financial_aid_id' => 4,'annual_financial_aid_name' => '15,000 +'],

        ];

        //Each University_Major row will have 8 related StudentBackground rows, each StudentBackground row will have 24
        //related Investment rows,so then each University_Major row has 576 possible combinations for Investment data.
        foreach($data as $row){
            DB::table('university_majors')->insert([
                'id'            => $row->id,
                'hegis_code'    => $row->hegis_code,
                'college_id'    => $row->college_id,
                'university_id' => $row-> university_id
            ]);

            foreach($age_ranges as $age_range){
                foreach($education_levels as $education_level){
                    $student_background = factory(StudentBackground::class)->create([
                        'university_major_id' => $row->id,
                        'age_range_id' => $age_range['age_range_id'],
                        'age_range_name' => $age_range['age_range_name'],
                        'education_level' => $education_level
                    ]);
                    foreach($annual_earnings as $annual_earning){
                        foreach($annual_financial_aid as $annual_aid){
                            factory(Investment::class)->create([
                                'student_background_id'     => $student_background->id,
                                'annual_earnings_id'        => $annual_earning['annual_earnings_id'],
                                'annual_earnings_name'      => $annual_earning['annual_earnings_name'],
                                'annual_financial_aid_id'   => $annual_aid['annual_financial_aid_id'],
                                'annual_financial_aid_name' => $annual_aid['annual_financial_aid_name'],
                            ]);
                        }
                    }
                }
            }

        };
    }
}
