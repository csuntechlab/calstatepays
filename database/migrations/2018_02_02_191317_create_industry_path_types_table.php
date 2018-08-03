<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryPathTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_path_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entry_status');
            $table->integer('naics_code');
            $table->integer('student_path');
            $table->integer('population_sample_id');
            $table->integer('university_majors_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industry_path_types');
    }
}
