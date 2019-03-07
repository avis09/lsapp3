<?php

use Illuminate\Database\Seeder;
use Illuminate\support\facades\DB;

class venuestatusseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venueStatus')->insert([
            'venueStatusType' => "Active"
        ]);
        DB::table('venueStatus')->insert([
            'venueStatusType' => "Inactive"
        ]);
        DB::table('venueStatus')->insert([
            'venueStatusType' => "Archive"
        ]);
    }
}
