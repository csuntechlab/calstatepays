<?php

use Illuminate\Database\Seeder;
use App\Models\Population;

class Populations_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/populations.json");
        $data = json_decode($json);
        foreach($data as $row){
            DB::table('populations')->insert([
                'id'               => $row->id,
                'population_found' => $row->population_found,
                'population_size'  => $row->population_size,
                'percentage_found' => $row->percentage_found
            ]);
        };
    }
}
