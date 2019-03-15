<?php

use Illuminate\Database\Seeder;
use Illuminate\support\facades\DB;

class equipmentstatusseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipmentstatus')->insert([
            'equipmentStatusName' => "Available"
        ]);
        DB::table('equipmentstatus')->insert([
            'equipmentStatusName' => "Unavailable"
        ]);
    }
}
