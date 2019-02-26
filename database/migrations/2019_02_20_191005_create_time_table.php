<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('time', function (Blueprint $table) {
            $table->increments('timeID');
            $table->unsignedInteger('venueTypeID');
            $table->foreign('venueTypeID')->references('venueTypeID')->on('venuetype');
            $table->string('startTime',20);
            $table->string('endTime',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time');
    }
}
