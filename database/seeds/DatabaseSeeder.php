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
        $this->call(Naics_Titles_TableSeeder::class);
        $this->call(Student_Paths_TableSeeder::class);
        $this->call(Field_Of_Studies_TableSeeder::class);
        $this->call(Hegis_Categories_TableSeeder::class);
        $this->call(Universities_TableSeeder::class);

        $this->call(Aggregate_Industry_Path_Types_TableSeeder::class);
        $this->call(Aggregate_Industry_Path_Wages_TableSeeder::class);
        $this->call(Aggregate_Industry_Population_TableSeeder::class);
        $this->call(Aggregate_Major_Path_TableSeeder::class);
        $this->call(Aggregate_Major_Path_Wages_TableSeeder::class);
        $this->call(Aggregate_University_Majors_TableSeeder::class);

        $this->call(Northridge_Industry_Path_Types_TableSeeder::class);
        $this->call(Northridge_Industry_Path_Wages_TableSeeder::class);
        $this->call(Northridge_Industry_Population_TableSeeder::class);
        $this->call(Northridge_Major_Path_TableSeeder::class);
        $this->call(Northridge_Major_Path_Wages_TableSeeder::class);
        $this->call(Northridge_University_Majors_TableSeeder::class);

        // $this->call(Master_FRE_Page_Data_TableSeeder::class);

        // $this->call(Industry_Different_Hegis_Same_Majors_Table_Seeder::class);
        // $this->call(Industry_Same_Hegis_Different_Majors_Table_Seeder::class);
        // $this->call(Majors_Same_Hegis_Different_Major_Table_Seeder::class);
        // $this->call(Majors_Same_Hegis_Different_Major_Table_Seeder::class);
    }
}
