<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueSchedule extends Model
{
    protected $table = 'venueschedule';

    public $primaryKey = 'venueScheduleID';

    public $timestamps = false;
    //  public $timestamps = [ "created_at" ];

    protected $fillable = [
//        'reservation_name', 'start_date', 'end_date'
        'venueID', 'timeID', 'venueSchedStatus'
    ];

//    public function setCreatedAtAttribute($value) {
//        $this->attributes['created_at'] = \Carbon\Carbon::now()->setTimezone('Asia/Manila');
//    }

    public function venue(){
        return $this->belongsTo('App\Venue', 'venueID');
    }

    public function time(){
        return $this->belongsTo('App\Time', 'timeID');
    }
}
