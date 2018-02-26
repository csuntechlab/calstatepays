<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ExcelController;

class Hegis_Codes_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('hegis_codes')->insert([
            'hegis_code' => ,
            'major' => ,
            'university' =>
        ]);
    }
}
