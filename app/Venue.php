<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classroom;
use Eloquent;

class Venue extends Model
{
    // Table Name
    protected $table ='venue';

    // Primary Key
    public $primaryKey = 'venueID';
    // Timestamps
     public $timestamps = false;

    protected $fillable = ['buildingID', 'venueName', 'venueFloorID', 'venueTypeID', 'userID'];

    public function f_scheduleV(){
        return $this->hasMany('App\Schedule');
    }

    public function f_buildingV(){
        return $this->hasMany('App\Building', 'buildingID');
    }
}
