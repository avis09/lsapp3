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

    protected $fillable = ['venueName'];

    public function f_classrooms(){
        return $this->hasMany('App\Classroom', 'roomID');
    }
}
