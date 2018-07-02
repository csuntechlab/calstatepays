<?php

use Illuminate\Database\Seeder;
use App\Models\StudentBackground;
use App\Models\Investment;
use App\Models\MajorPath;
use App\Models\UniversityMajor;
use App\Models\MajorPathWage;
use App\Models\Population;
use App\Models\IndustryPathType;
use Faker\Factory as Faker;
class University_Majors_Hybrid_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Data for Student_Background table
        $education_levels = ['FTT', 'FTF'];
        $age_ranges = [
            [ 'age_range_id' => 1],
            [ 'age_range_id' => 2],
            [ 'age_range_id' => 3],
            [ 'age_range_id' => 4]
        ];
        //Data for Investments table
        $annual_earnings = [
            [ 'annual_earnings_id' => 1],
            [ 'annual_earnings_id' => 2],
            [ 'annual_earnings_id' => 3],
            [ 'annual_earnings_id' => 4],
            [ 'annual_earnings_id' => 5],
            [ 'annual_earnings_id' => 6],
        ];
        $annual_financial_aid = [
            [ 'annual_financial_aid_id' => 1],
            [ 'annual_financial_aid_id' => 2],
            [ 'annual_financial_aid_id' => 3],
            [ 'annual_financial_aid_id' => 4],

        ];

        //Data for major_paths table
        $student_paths = [
            [ 'student_path' => 1],
            [ 'student_path' => 2],
            [ 'student_path' => 4]
        ];
        $years = [
            ['years' => 2],
            ['years' => 5],
            ['years' => 10],
        ];

        //Data for_industry_path_types
        $naics = [
            ['code' => 21],
            ['code' => 11],
            ['code' => 22],
            ['code' => 55],
            ['code' => 48],
            ['code' => 23],
            ['code' => 71],
            ['code' => 53],
            ['code' => 72],
            ['code' => 42],
            ['code' => 56],
            ['code' => 31],
            ['code' => 44],
            ['code' => 92],
            ['code' => 52],
            ['code' => 54],
            ['code' => 62],
            ['code' => 61],

        ];

        $universityMajor = UniversityMajor::all();
        //Each University_Major row will have 8 related StudentBackground rows, each StudentBackground row will have 24
        //related Investment rows,so then each University_Major row has 576 possible combinations for Investment data.
        foreach($universityMajor as $university_major){
            foreach($age_ranges as $age_range){
                foreach($education_levels as $education_level){
                    $student_background = factory(StudentBackground::class)->create([
                        'university_major_id' => $university_major->id,
                        'age_range_id' => $age_range['age_range_id'],
                        'education_level' => $education_level
                    ]);
                    foreach($annual_earnings as $annual_earning){
                        foreach($annual_financial_aid as $annual_aid){
                            factory(Investment::class)->create([
                                'student_background_id'     => $student_background->id,
                                'annual_earnings_id'        => $annual_earning['annual_earnings_id'],
                                'annual_financial_aid_id'   => $annual_aid['annual_financial_aid_id'],
                            ]);
                        }
                    }
                }
            }

            //Dummy Data for FRE PAge
            foreach($naics as $naic){
                $faker = Faker::create();
                $population_found = $faker->numberBetween(500, 1500);
                $population_size = $faker->numberBetween(5000, 9000);
                $population = new Population();
                $population->population_found = $population_found;
                $population->population_size = $population_size;
                $population->percentage_found = ($population_found/$population_size) * 100;
                $population->save();
                factory(IndustryPathType::class)->create([
                    'naics_code'           => $naic['code'],
                    'university_majors_id' => $university_major->id,
                    'population_sample_id' => $population->id
                ]);
            }
        };
    }
}
