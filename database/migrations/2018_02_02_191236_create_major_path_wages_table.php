<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorPathWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('major_path_wages', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('avg_annual_wage')->nullable();
            $table->integer('25th')->nullable();
            $table->integer('50th')->nullable();
            $table->integer('75th')->nullable();
            $table->integer('population_sample_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('major_path_wages');
    }
}
