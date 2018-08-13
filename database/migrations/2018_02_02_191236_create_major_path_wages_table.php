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
            $table->integer('major_path_id');
            $table->integer('_25th')->nullable();
            $table->integer('_50th')->nullable();
            $table->integer('_75th')->nullable();
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
