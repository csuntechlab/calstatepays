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
class Master_Industry_Page_Data_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        foreach($universityMajor as $university_major){


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
