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
        $this->call('departmentSeeder');
        $this->call('equipmentstatusseeder');
        $this->call('statusseeder');
        $this->call('userRoleSeeder');
        $this->call('userstatusseeder');
        $this->call('venuefloorseeder');
        $this->call('venuestatusseeder');
        $this->call('venuetypeseeder');
        $this->call('timetableseeder');
        $this->call('usersseeder');
        $this->call('venueSeeder');
        $this->call('XequipmentSeeder');
        $this->call('reservationSettingsSeeder');
    }
}

