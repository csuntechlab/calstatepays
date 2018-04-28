<?php

use Illuminate\Database\Seeder;

class testSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\UniversityMajor::class, 5)->create();
        factory(App\Models\IndustryPathType::class, 5)->create(['university_majors_id' => 1]);
        factory(App\Models\Population::class, 5)->create();
    }
}
