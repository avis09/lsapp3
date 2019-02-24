<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    // Table Name
    protected $table ='time';

    // Primary Key
    public $primaryKey = 'timeID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['timeStartTime', 'timeEndTime'];

    public function f_scheduleT(){
        return $this->belongsTo('App\Schedule');
    }

    public function venueSched(){
        return $this->hasMany('App\VenueSchedule', 'timeID');
    }
}
