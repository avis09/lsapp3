<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('scheduleID');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users');
            $table->string('purpose','250');
            $table->dateTime('created_at');
            $table->string('scheduleStatus','50');
            $table->date('date');
            $table->unsignedInteger('venueID');
            $table->foreign('venueID')->references('venueID')->on('venue');
            $table->unsignedInteger('timeID');
            $table->foreign('timeID')->references('timeID')->on('time');
            $table->dateTime('update_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
