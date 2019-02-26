<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class departmentseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department')->insert([
            'departmentType' => "Registrar"
        ]);
        DB::table('department')->insert([
            'departmentType' => "GASD"
        ]);
        DB::table('department')->insert([
            'departmentType' => "ITD"
        ]);
        DB::table('department')->insert([
            'departmentType' => "SMIT"
        ]);
    }
}
