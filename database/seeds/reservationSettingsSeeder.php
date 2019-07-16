<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class reservationSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservationSettings')->insert([
            'userID' => 1,
            'startDate' => "2019-07-15",
            'endDate' => "2019-09-15",
            'updated_at' => Carbon::now(),
        ]);
    }
}
