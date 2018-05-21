<?php

$factory->define(App\Models\Investment::class, function (Faker\Generator $faker, $param){
    return [
        'annual_earnings_id'      => $param['annual_earnings'],
        'annual_financial_aid_id' => $param['annual_financial_aid'],
        'time_to_degree'          => $faker->numberBetween(2,12),
        'earnings_5_years'        => $faker->numberBetween(30000,90000),
        'roi'                     => $faker->randomFloat(2,2,15)
    ];
});
