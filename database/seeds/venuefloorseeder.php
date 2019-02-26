<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'venueFloorName' => "First Floor"
        ]);
        DB::table('venuefloor')->insert([
            'venueFloorName' => "Second Floor"
        ]);
        DB::table('venuefloor')->insert([
            'venueFloorName' => "Third Floor"
        ]);
        DB::table('venuefloor')->insert([
            'venueFloorName' => "Fourth Floor"
        ]);
        DB::table('venuefloor')->insert([
            'venueFloorName' => "Fifth Floor"
        ]);
    }
}
