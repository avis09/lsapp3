<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('equipmentID');
            $table->unsignedInteger('venueID');
            $table->foreign('venueID')->references('venueID')->on('venue');
            $table->string('barCode', '100')->unique();
            $table->unsignedInteger('statusID');
            $table->foreign('statusID')->references('statusID')->on('status');
            $table->dateTime('dateModified')->nullable();
            $table->dateTime('dateArchieved')->nullable();
            $table->dateTime('dateAdded');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
