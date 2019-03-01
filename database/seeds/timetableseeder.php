<?php

use Illuminate\Database\Seeder;

class timetableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time')->insert([
            'venueTypeID' => "1",
            'timeStartTime' => "08:00:00",
            'timeEndTime' => "09:30:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "1",
            'timeStartTime' => "09:40:00",
            'timeEndTime' => "11:10:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "1",
            'timeStartTime' => "11:20:00",
            'timeEndTime' => "12:50:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "1",
            'timeStartTime' => "13:00:00",
            'timeEndTime' => "14:30:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "1",
            'timeStartTime' => "14:40:00",
            'timeEndTime' => "16:10:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "1",
            'timeStartTime' => "16:20:00",
            'timeEndTime' => "17:50:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "1",
            'timeStartTime' => "18:00:00",
            'timeEndTime' => "19:30:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "1",
            'timeStartTime' => "19:45:00",
            'timeEndTime' => "21:15:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "07:00:00",
            'timeEndTime' => "08:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "08:00:00",
            'timeEndTime' => "09:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "09:00:00",
            'timeEndTime' => "10:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "10:00:00",
            'timeEndTime' => "11:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "11:00:00",
            'timeEndTime' => "12:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "12:00:00",
            'timeEndTime' => "13:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "13:00:00",
            'timeEndTime' => "14:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "14:00:00",
            'timeEndTime' => "15:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "15:00:00",
            'timeEndTime' => "16:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "16:00:00",
            'timeEndTime' => "17:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "17:00:00",
            'timeEndTime' => "18:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "18:00:00",
            'timeEndTime' => "19:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "19:00:00",
            'timeEndTime' => "20:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "20:00:00",
            'timeEndTime' => "21:00:00"
        ]);
        DB::table('time')->insert([
            'venueTypeID' => "2",
            'timeStartTime' => "21:00:00",
            'timeEndTime' => "22:00:00"
        ]);
    }
}
