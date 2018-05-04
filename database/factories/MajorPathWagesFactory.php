<?php

$factory->define(App\Models\MajorPathWage::class, function (Faker\Generator $faker){
    $wage = $faker->numberBetween(35000, 120000);
    $_25th = $wage/2;
    $_50th = $_25th + $faker->numberBetween(0, $_25th);
    $_75th = $faker->numberBetween($_50th, $wage);
    return [
        'major_path_id'        => $faker->unique()->numberBetween(1,1000),
        'avg_annual_wage'      => $wage,
        '_25th'                 => $_25th,
        '_50th'                 => $_50th,
        '_75th'                 => $_75th,
        'population_sample_id' =>$faker->unique()->numberBetween(1,1000)
    ];
});
