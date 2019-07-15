<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservationsettings', function (Blueprint $table) {
            $table->increments('reservationSettingsID');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users');
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservationsettings');
    }
}
