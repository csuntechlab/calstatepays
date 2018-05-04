<?php

$json = File::get("database/data/naics_titles.json");
$data = json_decode($json, true);

$factory->define(App\Models\NaicsTitle::class, function (Faker\Generator $faker) {
    dd($faker->shuffle($data));
    return [
        'naics_code' => $faker->unique()->numberBetween(10,80),
        'naics_title' => $faker->unique()->safeEmail,
        'image' => $password ?: $password = bcrypt('secret'),
    ];
});
