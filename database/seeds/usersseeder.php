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
            'firstName' => "Mark",
            'lastName' => "ITD",
            'password' => bcrypt('12345678'),
            'phoneNumber' => '639171663964',
            'email' => 'itd@yahoo.com',
            'apiToken' => Str::random(60),
            'IDnumber' => '11501004',
            'fcmtoken' => Str::random(60)


        ]);
        DB::table('users')->insert([
            'userRoleID' => "2",
            'departmentID' => "2",
            'userStatusID' => "1",
            'firstName' => "Juan",
            'lastName' => "Gasd",
            'password' => bcrypt('12345678'),
            'phoneNumber' => '639171976664',
            'email' => 'gasd@yahoo.com',
            'apiToken' => Str::random(60),
            'IDnumber' => '11501002',
            'fcmtoken' => Str::random(60)


        ]);
        DB::table('users')->insert([
            'userRoleID' => "3",
            'departmentID' => "3",
            'userStatusID' => "1",
            'firstName' => "Peter",
            'lastName' => "Registrar",
            'password' => bcrypt('12345678'),
            'phoneNumber' => '639176245666',
            'email' => 'regis@yahoo.com',
            'apiToken' => Str::random(60),
            'IDnumber' => '11501003',
            'fcmtoken' => Str::random(60)


        ]);
        DB::table('users')->insert([
            'userRoleID' => "1",
            'departmentID' => "1",
            'userStatusID' => "1",
            'firstName' => "Roel",
            'lastName' => "Sevesa",
            'password' => bcrypt('12345678'),
            'phoneNumber' => '639178368850',
            'email' => 'roelsevesa@gmail.com',
            'apiToken' => Str::random(60),
            'IDnumber' => '11501001',
            'fcmtoken' => Str::random(60)


        ]);
    }
}
