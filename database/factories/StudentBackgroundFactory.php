<?php

$factory->define(App\Models\StudentBackground::class, function (Faker\Generator $faker, $param){

    return [
        'university_major_id'  => $param['university_major_id'],
        'age_range_id'         => $param['age_range_id'],
        'education_level' => $param['education_level'],
    ];
});
