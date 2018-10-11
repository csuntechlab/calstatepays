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
        $this->call(University_Majors_TableSeeder::class);
        $this->call(Naics_Titles_TableSeeder::class);
        $this->call(Student_Paths_TableSeeder::class);
        $this->call(Field_Of_Studies_TableSeeder::class);
        $this->call(Hegis_Categories_TableSeeder::class);
        $this->call(Universities_TableSeeder::class);
        $this->call(Major_Paths_TableSeeder::class);
        $this->call(Major_Path_Wages_TableSeeder::class);
        $this->call(Master_Industry_Path_Types_Table_Seeder::class);
        $this->call(Master_Industry_Wages_Table_Seeder::class);
        $this->call(Population_Table_Seeder::class);
        $this->call(Master_FRE_Page_Data_TableSeeder::class);
        
        $this->call(Same_Hegis_Different_Major_Error_Table_Seeder::class);
        $this->call(ERRORS_Universities_Majors_Seeder::class);
        $this->call(Industry_Different_Hegis_Same_Majors_Table_Seeder::class);
        $this->call(Industry_Same_Hegis_Different_Majors_Table_Seeder::class);
        // $this->call(Aggregate_same_hegis_different_majors::class);
        // $this->call(Aggregate_different_hegis_same_majors::class);
    }
}
