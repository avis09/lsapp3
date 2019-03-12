<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class XequipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipment')->insert([
            'venueID' => "2",
            'equipmentStatusID' => "1",
            'equipmentName' => "Cabinet, FILING LATER",
            'barCode' => "CP00000102-1111000250",
            'created_at'=> Carbon::now()

        ]);
        DB::table('equipment')->insert([
            'venueID' => "2",
            'equipmentStatusID' => "1",
            'equipmentName' => "COMPUTER, MONITOR 17",
            'barCode' => "CP00000829-1111221502",
            'created_at'=> Carbon::now()

        ]);
    }
}
