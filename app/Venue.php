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
        return $this->belongsTo('App\Building', 'buildingID');
    }
    public function f_venueTypeV(){
        return $this->belongsTo('App\VenueType', 'venueTypeID');
    }
    public function f_userV()
    {
        return $this->belongsTo('App\User');
    }

    public function f_pictureP()
    {
        return $this->hasMany('App\Picture');
    }

    public function venueSched(){
        return $this->hasMany('App\VenueSchedule', 'venueID');
    }

}
