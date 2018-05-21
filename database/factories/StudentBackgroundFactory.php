<?php
$education_array = ['FTF', 'FTT'];
$education_level = $faker->unique()->randomElement($education_array);

$factory->define(App\Models\StudentBackground::class, function (Faker\Generator $faker, $param){
    $returnData = [
        'age_range_id'        => $param['age_range_id'],
        'age_range_name'      => $age_range_name['age_range_name'],
        'education_level'     => $education_level,
        'investment_id'       => 1,
        'university_major_id' => 1
    ];
    return $returnData;
});
