<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call('buildingseeder');
        $this->call('departmentseeder');
        $this->call('statusseeder');
        $this->call('userroleseeder');
        $this->call('venuefloorseeder');
        $this->call('venuetypeseeder');
    }
}

