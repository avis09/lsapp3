<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public $primaryKey = 'scheduleID';

    public $timestamps = false;
  //  public $timestamps = [ "created_at" ];

    protected $fillable = [
//        'reservation_name', 'start_date', 'end_date'
         'scheduleID', 'userID', 'purpose', 'dateAdded', 'statusID', 'date', 'venueID', 'timeID'
    ];

    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = \Carbon\Carbon::now()->setTimezone('Asia/Manila');
    }

//    public function setUpdatedAtAttribute($value) {
//        $this->attributes['updated_at'] = \Carbon\Carbon::now();
//    }

    public function f_time(){
        return $this->hasMany('App\Time', 'timeID');
    }
    public function f_venue()
    {
        return $this->belongsTo('App\Venue', 'venueID');
    }
}
