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
$factory->define(App\Models\UniversityMajor::class, function (Faker\Generator $faker) {

    return [
        'hegis_code' => $faker->unique()->numberBetween(1000, 25000),
        'college_id' => $faker->numberBetween(1, 99),
        'university_id' => 1153,
    ];
});
