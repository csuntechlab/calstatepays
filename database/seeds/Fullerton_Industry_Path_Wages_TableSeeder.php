<?php

use Illuminate\Database\Seeder;
use App\Models\IndustryWage;

class Fullerton_Industry_Path_Wages_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/industryPathWagesData/Industry_Path_Wages_aggregate.json');
        $industry_path_wage = json_decode($json);

        foreach ($industry_path_wage as $row) {
            $industryPathWage = new IndustryWage();
            $industryPathWage->id = $row->id;
            $industryPathWage->avg_annual_wage_5 = $row->median_annual_wage_5;
            $industryPathWage->avg_annual_wage_10 = null;
            $industryPathWage->save();
        }
    }
}
