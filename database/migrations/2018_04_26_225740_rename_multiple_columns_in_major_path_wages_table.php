<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMultipleColumnsInMajorPathWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('major_path_wages', function($table){
            $table->renameColumn('25th', '_25th');
            $table->renameColumn('50th', '_50th');
            $table->renameColumn('75th', '_75th');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
