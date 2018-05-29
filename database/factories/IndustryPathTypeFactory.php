<?php

$factory->define(App\Models\IndustryPathType::class, function (Faker\Generator $faker){
    return [
        'entry_status' => "All",
        'naics_code' => $faker->numberBetween(1,80),
        'student_path' => 4,
        'population_sample_id'=> $faker->unique()->numberBetween(50000, 100000),
        'university_majors_id' => $faker->numberBetween(50000, )
    ];
});
