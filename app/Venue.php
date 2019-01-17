<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    // Table Name
    protected $table ='venue';

    // Primary Key
    public $primaryKey = 'venueID';
    // Timestamps
     public $timestamps = false;

    protected $fillable = ['venueName'];

    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }

}
