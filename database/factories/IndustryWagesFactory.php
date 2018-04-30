<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(app\Models\IndustryWage::class, function (Faker\Generator $faker) {

    return [
        'avg_annual_wage_5' => $faker->randomDigit,
        'avg_annual_wage_10' => $faker->randomDigit,
        'avg_annual_wage_15' => $faker->randomDigit
    ];
});
