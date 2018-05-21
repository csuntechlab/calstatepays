<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentBackgroundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('age_range_id');
            $table->string('age_range_name');
            $table->string('education_level');
            $table->string('university_major_id');
            $table->integer('investment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_backgrounds');
    }
}
