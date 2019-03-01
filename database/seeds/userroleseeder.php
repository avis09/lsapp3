<?php

use Illuminate\Database\Seeder;
use Illuminate\support\facades\DB;

class userRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userrole')->insert([
            'roleType' => "Students"
        ]);
        DB::table('userrole')->insert([
            'roleType' => "GASD"
        ]);
        DB::table('userrole')->insert([
            'roleType' => "Registrar"
        ]);
        DB::table('userrole')->insert([
            'roleType' => "ITD"
        ]);
    }
}
