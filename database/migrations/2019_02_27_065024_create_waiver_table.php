<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiver', function (Blueprint $table) {
            $table->increments('waiverID');
            $table->unsignedInteger('scheduleID');
            $table->foreign('scheduleID')->references('scheduleID')->on('schedules');
            $table->string('studentName','100')->nullable();
            $table->string('studentIDnumber','20')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waiver');
    }
}
