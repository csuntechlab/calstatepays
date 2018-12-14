<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePowerUsersDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_users_data', function (Blueprint $table) {
            /** MAKE NOT NULLABLE when all iframe paths are good */
            $table->integer('university_id');
            $table->integer('path_id');
            $table->string('iframe_string')->nullable();
            $table->integer('opt_in');
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
        Schema::dropIfExists('power_users_data');
    }
}
