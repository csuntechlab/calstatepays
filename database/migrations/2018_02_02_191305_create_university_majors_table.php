<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversityMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_majors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hegis_code');
            $table->integer('university_id');
            $table->string('major');
            $table->unique(array('hegis_code', 'university_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('university_majors');
    }
}
