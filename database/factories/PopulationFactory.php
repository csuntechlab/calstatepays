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
$factory->define(App\Models\Population::class, function (Faker\Generator $faker, $params) {
    $population_found = $faker->numberBetween(500, 1500);
    $population_size = $faker->numberBetween(5000, 9000);

    return [
        'id' => $params['id'],
        'population_found' => $population_found,
        'population_size' => $population_size,
        'percentage_found' => ($population_found/$population_size) * 100,
    ];
});
