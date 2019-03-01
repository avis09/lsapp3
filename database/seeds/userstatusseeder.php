<?php

use Illuminate\Database\Seeder;
use Illuminate\support\facades\DB;

class userstatusseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userstatus')->insert([
            'userStatusType' => "Active"
        ]);
        DB::table('userstatus')->insert([
            'userStatusType' => "Inactive"
        ]);
        DB::table('userstatus')->insert([
            'userStatusType' => "Archive"
        ]);
    }
}
