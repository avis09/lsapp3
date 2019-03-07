<?php

use Illuminate\Database\Seeder;

class statusseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'statusName' => "Pending",
        ]);
        DB::table('status')->insert([
            'statusName' => "Approved",
        ]);
        DB::table('status')->insert([
            'statusName' => "Cancelled",
        ]);
        DB::table('status')->insert([
            'statusName' => "Done",
        ]);
    }
}
