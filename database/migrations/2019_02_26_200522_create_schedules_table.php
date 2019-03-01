<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
        $table->increments('scheduleID');
        $table->unsignedInteger('userID');
        $table->foreign('userID')->references('userID')->on('users');
        $table->unsignedInteger('venueID');
        $table->foreign('venueID')->references('venueID')->on('venue');
        $table->unsignedInteger('timeID');
        $table->foreign('timeID')->references('timeID')->on('time');
        $table->unsignedInteger('statusID');
        $table->foreign('statusID')->references('statusID')->on('status');
        $table->string('purpose','250');
        $table->string('updatedMessage','250')->nullable();
        $table->date('date');
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
        Schema::dropIfExists('schedules');
    }
}
