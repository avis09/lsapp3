<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class departmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department')->insert([
            'departmentName' => "SMIT"
        ]);
        DB::table('department')->insert([
            'departmentName' => "GASD"
        ]);
        DB::table('department')->insert([
            'departmentName' => "Registrar"
        ]);
        DB::table('department')->insert([
            'departmentName' => "ITD"
        ]);
    }
}
