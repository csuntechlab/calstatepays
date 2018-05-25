<?php

$factory->define(App\Models\StudentBackground::class, function (Faker\Generator $faker, $param){

    return [
        'university_major_id'  => $param['university_major_id'],
        'age_range_id'         => $param['age_range_id'],
        'age_range_name'       => $param['age_range_name'],
        'education_level_name' => $param['education_level_name'],
    ];
});
