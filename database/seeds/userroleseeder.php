<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userroleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userrole')->insert([
            'roleType' => "Student"
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
