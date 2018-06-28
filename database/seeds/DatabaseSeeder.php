<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Hegis_Codes_TableSeeder::class);
        $this->call(Universities_TableSeeder::class);
        $this->call(Naics_Titles_TableSeeder::class);
        $this->call(Student_Paths_TableSeeder::class);
        $this->call(Field_Of_Studies_TableSeeder::class);
        $this->call(Hegis_Categories_TableSeeder::class);

        $this->call(University_Majors_TableSeeder::class);
        
        /*$this->call(Major_Paths_TableSeeder::class);*/
    }
}
