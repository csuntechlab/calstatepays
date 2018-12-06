<?php

use Illuminate\Database\Seeder;

use App\Models\Investment;

class Investments_Template_Northridge_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = File::get('database/data/samplePFRE.json');
        // do not delete, need for future
        // $json = File::get('database/data/investmentsData/investments_northridge.json');
        $industry_path = json_decode($json);

        foreach ($industry_path as $row) {
            $investment = new Investment();
            $investment->id = $row->id;
            $investment->student_background_id = $row->student_background_id;
            $investment->annual_earnings_id = $row->annual_earnings_id; // during school
            $investment->annual_financial_aid_id = $row->annual_earnings_id;
            $investment->time_to_degree = $row->estimated_time_to_degree;// in years
            $investment->earnings_5_years = $row->estimated_earnings_5_years_after_exit;
            $investment->roi = $row->fre_financial_return_on_education;
            $investment->save();
        }
    }
}
