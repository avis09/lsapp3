<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class buildingseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('building')->insert([
            'buildingName' => "Sandejas Building"
        ]);
        DB::table('building')->insert([
            'buildingName' => "Main Building"
        ]);
    }
}
