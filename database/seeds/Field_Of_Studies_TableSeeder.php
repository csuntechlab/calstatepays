<?php

use Illuminate\Database\Seeder;
use App\Models\FieldOfStudy;

class Field_Of_Studies_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/field_of_studies.json");
        $data = json_decode($json);
        foreach($data as $row) {
            DB::table('field_of_studies')->insert([
                'name'                 => $row->name,
                'id'                   => $row->id,
            ]);
        }
    }
}
