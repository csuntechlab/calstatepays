<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustrySameHegisDifferentMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_same_hegis_different_majors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hegis_code');
            $table->integer('university_id');
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
        Schema::dropIfExists('industry_same_hegis_different_majors');
    }
}
