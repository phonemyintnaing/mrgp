<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalInfoToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('imageLink')->nullable();
            $table->string('nid')->nullable();
            $table->string('dob');
            $table->string('Dad');
            $table->string('Mom');
            $table->string('biosocial')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            //'imageLink', 'nid', 'dob', 'Dad', 'Mom', 'biosocial'
            $table->dropColumn('imageLink');
            $table->dropColumn('nid');
            $table->dropColumn('dob');
            $table->dropColumn('Dad');
            $table->dropColumn('Mom');
            $table->dropColumn('biosocial');

        });
    }
}
