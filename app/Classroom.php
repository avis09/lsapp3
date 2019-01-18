<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    // Table Name
    protected $table ='rooms';

    // Primary Key
    public $primaryKey = 'roomsID';
    // public $table->foreign('venue_id')->references('id')->on('venues');
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['RoomFloor', 'RoomNumber', 'venueID'];
    public function venues(){
        return $this->hasMany('App\Venue');
    }
}
