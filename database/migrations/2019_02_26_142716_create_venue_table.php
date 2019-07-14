<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue', function (Blueprint $table) {
            $table->increments('venueID');
            $table->unsignedInteger('buildingID');
            $table->foreign('buildingID')->references('buildingID')->on('building');
            $table->unsignedInteger('venueFloorID');
            $table->foreign('venueFloorID')->references('venueFloorID')->on('venuefloor');
            $table->unsignedInteger('venueTypeID');
            $table->foreign('venueTypeID')->references('venueTypeID')->on('venuetype');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users');
            $table->unsignedInteger('venueStatusID');
            $table->foreign('venueStatusID')->references('venueStatusID')->on('venuestatus');
            $table->string('venueName','50');
            $table->string('venueCapacity','30');
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
        Schema::dropIfExists('venue');
    }
}
