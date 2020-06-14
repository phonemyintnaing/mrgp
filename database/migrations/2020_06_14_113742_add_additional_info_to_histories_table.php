<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalInfoToHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
             $table->string('res')->nullable();
             $table->string('xRayLink')->nullable();
             $table->string('mriLink')->nullable();
             $table->string('ctLink')->nullable();
             $table->string('usLink')->nullable();
             $table->string('bill')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropcolumn('res');
           $table->dropcolumn('xRayLink');
            $table->dropcolumn('mriLink');
            $table->dropcolumn('ctLink');
            $table->dropcolumn('usLink');
            $table->dropcolumn('bill');

        });
    }
}
