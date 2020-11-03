<?php

use Illuminate\Database\Seeder;

class Pfre_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/pfre.json");
        $data = json_decode($json);
        foreach ($data as $row) {
            DB::table('pfres')->insert([
                'id'                  => $row->guid,
                'entry_status'          => $row->entry_status,
                'major'                 => $row->major,
                'in_school_earning'     => $row->in_school_earning,
                'fin_aid_0'             => $row->fin_aid_0,
                'fin_aid_3000'          => $row->fin_aid_3000,
                'fin_aid_10000'         => $row->fin_aid_10000
            ]);
        }
    }
}
