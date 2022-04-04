<?php

use Illuminate\Database\Seeder;
use App\Models\IndustryPathType;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Pfre_TableSeeder::class);
        $this->call(Field_Of_Studies_TableSeeder::class);
        $this->call(Hegis_Categories_TableSeeder::class);
        $this->call(Hegis_Codes_TableSeeder::class);
        $this->call(Naics_Titles_TableSeeder::class);
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

        $this->call(Channel_Islands_Industry_Path_Types_TableSeeder::class);
        $this->call(Channel_Islands_Industry_Path_Wages_TableSeeder::class);
        $this->call(Channel_Islands_Industry_Population_TableSeeder::class);
        $this->call(Channel_Islands_Major_Path_TableSeeder::class);
        $this->call(Channel_Islands_Major_Path_Wages_TableSeeder::class);
        $this->call(Channel_Islands_University_Majors_TableSeeder::class);

        $this->call(Dominguez_Hills_Industry_Path_Types_TableSeeder::class);
        $this->call(Dominguez_Hills_Industry_Path_Wages_TableSeeder::class);
        $this->call(Dominguez_Hills_Industry_Population_TableSeeder::class);
        $this->call(Dominguez_Hills_Major_Path_TableSeeder::class);
        $this->call(Dominguez_Hills_Major_Path_Wages_TableSeeder::class);
        $this->call(Dominguez_Hills_University_Majors_TableSeeder::class);

        $this->call(Fullerton_Industry_Path_Types_TableSeeder::class);
        $this->call(Fullerton_Industry_Path_Wages_TableSeeder::class);
        $this->call(Fullerton_Industry_Population_TableSeeder::class);
        $this->call(Fullerton_Major_Path_TableSeeder::class);
        $this->call(Fullerton_Major_Path_Wages_TableSeeder::class);
        $this->call(Fullerton_University_Majors_TableSeeder::class);

        $this->call(Long_Beach_Industry_Path_Types_TableSeeder::class);
        $this->call(Long_Beach_Industry_Path_Wages_TableSeeder::class);
        $this->call(Long_Beach_Industry_Population_TableSeeder::class);
        $this->call(Long_Beach_Major_Path_TableSeeder::class);
        $this->call(Long_Beach_Major_Path_Wages_TableSeeder::class);
        $this->call(Long_Beach_University_Majors_TableSeeder::class);

        // $this->call(Los_Angeles_Industry_Path_Types_TableSeeder::class);
        // $this->call(Los_Angeles_Industry_Path_Wages_TableSeeder::class);
        // $this->call(Los_Angeles_Industry_Population_TableSeeder::class);
        // $this->call(Los_Angeles_Major_Path_TableSeeder::class);
        // $this->call(Los_Angeles_Major_Path_Wages_TableSeeder::class);
        // $this->call(Los_Angeles_University_Majors_TableSeeder::class);

        $this->call(Pomona_Industry_Path_Types_TableSeeder::class);
        $this->call(Pomona_Industry_Path_Wages_TableSeeder::class);
        $this->call(Pomona_Industry_Population_TableSeeder::class);
        $this->call(Pomona_Major_Path_TableSeeder::class);
        $this->call(Pomona_Major_Path_Wages_TableSeeder::class);
        $this->call(Pomona_University_Majors_TableSeeder::class);

        /** Investment Data Seeders */
        // $this->call(Investments_Template_Northridge_TableSeeder::class);
        // $this->call(Investments_Template_All_TableSeeder::class);

        /** Student Backgrounds */
        // $this->call(Student_Backgrounds_Template_Northridge_TableSeeder::class);
        // $this->call(Student_Backgrounds_Template_All_TableSeeder::class);

        // $this->call(Industry_Different_Hegis_Same_Majors_Table_Seeder::class);
        // $this->call(Industry_Same_Hegis_Different_Majors_Table_Seeder::class);
        // $this->call(Majors_Same_Hegis_Different_Major_Table_Seeder::class);
        // $this->call(Majors_Different_Hegis_Same_Major_Table_Seeder::class);

        /** IFrame seeders */
        $this->call(Power_User_Data_Aggregate_TableSeeder::class);
        $this->call(Power_User_Data_Northridge_TableSeeder::class);
        $this->call(Power_User_Data_Channel_Islands_TableSeeder::class);
        $this->call(Power_User_Data_Dominguez_Hills_TableSeeder::class);
        $this->call(Power_User_Data_Fullerton_TableSeeder::class);
        $this->call(Power_User_Data_Long_Beach_TableSeeder::class);
        // $this->call(Power_User_Data_Los_Angeles_TableSeeder::class);
        $this->call(Power_User_Data_Pomona_TableSeeder::class);

        $this->call(Power_User_Card_Images_TableSeeder::class);

    }
}
