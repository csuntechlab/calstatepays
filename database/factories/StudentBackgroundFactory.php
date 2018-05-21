<?php

$factory->define(App\Models\StudentBackground::class, function (Faker\Generator $faker, $param){
    $education_array = ['FTF', 'FTT'];
    $education_level = $faker->randomElement($education_array);

    return [
        'age_range_id'        => $param['age_range_id'],
        'education_level'     => $education_level,
        'investment_id'       => 1,
        'university_major_id' => 1
    ];
});
