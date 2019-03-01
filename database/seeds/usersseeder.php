<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class usersseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'userRoleID' => "4",
            'departmentID' => "4",
            'userStatusID' => "1",
            'firstName' => "ITD first name",
            'lastName' => "ITD last name",
            'password' => bcrypt('12345678'),
            'phoneNumber' => '09171676964',
            'email' => 'itd@yahoo.com',
            'apiToken' => Str::random(60),
            'IDnumber' => '11501004',
            'fcmtoken' => Str::random(60)


        ]);
        DB::table('users')->insert([
            'userRoleID' => "2",
            'departmentID' => "2",
            'userStatusID' => "1",
            'firstName' => "GASD first name",
            'lastName' => "GASD last name",
            'password' => bcrypt('12345678'),
            'phoneNumber' => '09171976964',
            'email' => 'gasd@yahoo.com',
            'apiToken' => Str::random(60),
            'IDnumber' => '11501002',
            'fcmtoken' => Str::random(60)


        ]);
        DB::table('users')->insert([
            'userRoleID' => "3",
            'departmentID' => "3",
            'userStatusID' => "1",
            'firstName' => "registrar first name",
            'lastName' => "registrar last name",
            'password' => bcrypt('12345678'),
            'phoneNumber' => '09171376964',
            'email' => 'regis@yahoo.com',
            'apiToken' => Str::random(60),
            'IDnumber' => '11501003',
            'fcmtoken' => Str::random(60)


        ]);
        DB::table('users')->insert([
            'userRoleID' => "1",
            'departmentID' => "1",
            'userStatusID' => "1",
            'firstName' => "student first name",
            'lastName' => "student last name",
            'password' => bcrypt('12345678'),
            'phoneNumber' => '09171376964',
            'email' => 'student@yahoo.com',
            'apiToken' => Str::random(60),
            'IDnumber' => '11501001',
            'fcmtoken' => Str::random(60)


        ]);
    }
}
