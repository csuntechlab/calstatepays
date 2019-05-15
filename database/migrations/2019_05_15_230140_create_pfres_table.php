<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePfresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pfres', function (Blueprint $table) {
            $table->string('guid');
            $table->string('entry_status');
            $table->string('major');
            $table->string('in_school_earning');
            $table->string('fin_aid_0');
            $table->string('fin_aid_3000');
            $table->string('fin_aid_10000');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pfres');
    }
}
