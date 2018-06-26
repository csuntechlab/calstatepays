<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_wages', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('avg_annual_wage_5')->nullable();
            $table->integer('avg_annual_wage_10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industry_wages');
    }
}
