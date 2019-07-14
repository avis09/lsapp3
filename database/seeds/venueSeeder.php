<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class venueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venue')->insert([
            'buildingID' => "1",
            'venueFloorID' => "1",
            'venueTypeID' => "2",
            'userID' => "2",
            'venueStatusID' => "1",
            'venueName' => "Sandejas Court",
            'venueCapacity' => "8",
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        DB::table('venue')->insert([
            'buildingID' => "2",
            'venueFloorID' => "3",
            'venueTypeID' => "1",
            'userID' => "3",
            'venueStatusID' => "1",
            'venueName' => "B301",
            'venueCapacity' => "8",
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
    }
}
