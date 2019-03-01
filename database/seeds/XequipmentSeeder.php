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
            'equipmentName' => "Chair",
            'barCode' => "asdjckasiiasiASxcasdas",
            'created_at'=> Carbon::now()

        ]);
    }
}
