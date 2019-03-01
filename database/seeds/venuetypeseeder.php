<?php

use Illuminate\Database\Seeder;
use Illuminate\support\facades\DB;

class venuetypeseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venuetype')->insert([
            'venueTypeName' => "Room"
        ]);
        DB::table('venuetype')->insert([
            'venueTypeName' => "Court"
        ]);
    }
}
