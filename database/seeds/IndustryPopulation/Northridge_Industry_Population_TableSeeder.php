<?php

use Illuminate\Database\Seeder;
use App\Models\Population;

class Northridge_Industry_Population_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/populationData/Industry_Population_northridge.json');
        $industry_population = json_decode($json);

        foreach ($industry_population as $row) {
            $population = new Population();
            $population->id = $row->id;
            $population->population_found = ( int )$row->population_found_5;
            $population->save();
        }
    }
}
