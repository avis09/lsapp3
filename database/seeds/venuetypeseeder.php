<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'venueTypeName' => "Court"
        ]);
        DB::table('venuetype')->insert([
            'venueTypeName' => "Room"
        ]);
    }
}
