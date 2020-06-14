<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('user_id');
            $table->string('fever');
            $table->string('bpressure');
            $table->string('weight');
            $table->string('pulse');
            $table->string('complaint');
            $table->string('diseases');
            $table->string('remarks');
            $table->string('treatplan');
            $table->string('otherhistory');
            $table->string('finding_phy');
            $table->string('finding_dm');
            $table->string('finding_lab');

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
        Schema::dropIfExists('histories');
    }
}
