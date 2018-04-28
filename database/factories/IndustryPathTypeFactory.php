<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\IndustryPathType::class, function (Faker\Generator $faker, $params) {

    return [
        'entry_status' => "All",
        'naics_code' => $faker->numberBetween(1, 99),
        'student_path' => 4,
        'population_sample_id'=> $faker->unique()->numberBetween(1, 999),
        'university_majors_id' => $params['university_majors_id']
    ];
});
