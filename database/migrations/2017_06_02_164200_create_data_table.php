<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->date('date');
            $table->float('temperature');
            $table->string('menstruation');
            $table->string('amount_bleeding');
            $table->string('pain');
            $table->string('medicine');
            $table->string('discharge');
            $table->string('amount_discharge');
            $table->string('color');
            $table->string('behavior');
            $table->string('bleeding');
            $table->string('body');
            $table->string('heart');
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
        //
        Schema::drop('data');
    }
}
