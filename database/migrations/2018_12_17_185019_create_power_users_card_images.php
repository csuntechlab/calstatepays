<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePowerUsersCardImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_users_card_images', function (Blueprint $table) {
            $table->integer('id');
            $table->string('university');
            $table->string('card_image');
            $table->smallInteger('opt_in');// Whether a CSU wants to have their info displayed or not
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('power_users_card_images');
    }
}
