<?php
$json = File::get("database/data/naics_titles.json");
$data = json_decode($json, true);

$factory->define(App\Models\NaicsTitle::class, function (Faker\Generator $faker) use($data) {
    $row = $faker->unique()->randomElement($data);
    return [
        'naics_code' => $row['naics_code'],
        'naics_title' => $row->['naics_title'],
        'image' => $row->image
    ];
});
