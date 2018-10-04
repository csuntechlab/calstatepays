<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAggregateDifferentHegisSameMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Aggregate_different_hegis_same_majors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hegis_code');
            $table->string('university');
            $table->string('major');
            $table->string('entry_status');
            $table->string('student_path');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Aggregate_different_hegis_same_majors');
    }
}
