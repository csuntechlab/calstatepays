<?php

$factory->define(App\Models\IndustryPathType::class, function (Faker\Generator $faker){
    return [
        'entry_status' => "All",
        'naics_code' => $faker->numberBetween(1,80),
        'student_path' => 4,
        'population_sample_id'=> $faker->unique()->numberBetween(1, \App\Models\Population::count()),
        'university_majors_id' => $faker->numberBetween(1, \App\Models\UniversityMajor::count())
    ];
});
