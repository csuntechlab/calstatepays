<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(app\Models\IndustryWage::class, function (Faker\Generator $faker) {

    return [
        'avg_annual_wage_5' => $faker->rand(30000,50000),
        'avg_annual_wage_10' => $faker->rand(50000,80000),
        'avg_annual_wage_15' => $faker->rand(80000,150000)
    ];
});
