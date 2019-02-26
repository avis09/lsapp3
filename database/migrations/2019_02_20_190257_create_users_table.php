<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('userID');
            $table->unsignedInteger('userRoleID');
            $table->foreign('userRoleID')->references('userRoleID')->on('userrole');
            $table->unsignedInteger('departmentID');
            $table->foreign('departmentID')->references('departmentID')->on('department');
            $table->string('firstName',80);
            $table->string('lastName',80);
            $table->string('password',120);
            $table->string('phoneNumber','20')->nullable();
            $table->string('email','100')->unique();
            $table->unsignedInteger('statusID');
            $table->foreign('statusID')->references('statusID')->on('status');
            $table->string('apiToken','250');
            $table->string('fcmToken','250');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
