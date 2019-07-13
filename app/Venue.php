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

    protected $fillable = ['buildingID', 'venueFloorID', 'venueTypeID', 'userID', 'venueStatusID','venueName','created_at','updated_at'];

    public function f_scheduleV(){
        return $this->hasMany('App\Schedule', 'venueID');
    }

    public function f_buildingV(){
        return $this->belongsTo('App\Building', 'buildingID');
    }
    public function f_venueTypeV(){
        return $this->belongsTo('App\VenueType', 'venueTypeID');
    }
    public function f_venueStatusV(){
        return $this->belongsTo('App\VenueStatus', 'venueStatusID');
    }
    public function f_userV()
    {
        return $this->belongsTo('App\User', 'userID');
    }

    public function pictures()
    {
        return $this->hasMany('App\Picture', 'venueID');
    }

    Public function f_equipment()
    {
        return $this->hasMany('App\Equipment', 'venueID');
    }

    public function venueSched(){
        return $this->hasMany('App\VenueSchedule', 'venueID');
    }

    public function floor(){
         return $this->belongsTo('App\VenueFloor', 'venueFloorID');
    }

    public function f_feedbacksV(){
        return $this->hasMany('App\Feedback', 'venueID');
    }
}
