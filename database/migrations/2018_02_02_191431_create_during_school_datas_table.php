<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuringSchoolDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('during_school_datas', function (Blueprint $table) {
            $table->integer('university_id');
            $table->integer('student_path');
            $table->string('entry_status');
            $table->integer('potential_num_students');
            $table->integer('num_students_non_year');
            $table->integer('median_earnings_non_year');
            $table->integer('num_students_enrolled');
            $table->integer('num_students_full_year');
            $table->integer('median_earnings_full_year');
            $table->integer('year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('during_school_datas');
    }
}
