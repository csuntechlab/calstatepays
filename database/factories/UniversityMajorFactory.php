<?php
$json = File::get("database/data/university_majors.json");
$data = json_decode($json, true);

$factory->define(App\Models\UniversityMajor::class, function (Faker\Generator $faker) use($data){
    $row = $faker->unique()->randomElement($data);
    return [
        'hegis_code' => $row['hegis_code'],
        'college_id' => $row['college_id'],
        'university_id' => $row['university_id']
    ];
});
