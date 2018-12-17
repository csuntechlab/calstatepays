<?php

use Illuminate\Database\Seeder;
use App\Models\Investment;

class Investments_Template_All_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/sample_all_PFRE.json');
        $industry_path = json_decode($json);

        foreach ($industry_path as $row) {
            $investment = new Investment();
            $investment->id = $row->investment_id;
            $investment->student_background_id = $row->student_background_id;
            $investment->time_to_degree = $row->estimated_time_to_degree;// in years
            $investment->earnings_5_years = $row->estimated_earnings_5_years_after_exit;
            $investment->roi = $row->fre_financial_return_on_education;
            $investment->save();
        }
    }
}
