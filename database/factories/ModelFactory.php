<?php

$factory->define(App\Models\Population::class, function (Faker\Generator $faker){
    $population_found = $faker->numberBetween(500, 1500);
    $population_size  = $faker->numberBetween(2000,4700);
    $percentage_found = $population_found/$population_size;
    return [
        'population_found' => $population_found,
        'population_size' => $population_size,
        'percentage_found' => $percentage_found
    ];
});
