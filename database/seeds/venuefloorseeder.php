<?php

use Illuminate\Database\Seeder;
use Illuminate\support\facades\DB;

class venuefloorseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venuefloor')->insert([
            'venueFloorName' => "Ground"
        ]);
        DB::table('venuefloor')->insert([
            'venueFloorName' => "2nd Floor"
        ]);
        DB::table('venuefloor')->insert([
            'venueFloorName' => "3rd Floor"
        ]);
        DB::table('venuefloor')->insert([
            'venueFloorName' => "4th Floor"
        ]);
        DB::table('venuefloor')->insert([
            'venueFloorName' => "5th Floor"
        ]);
    }
}
