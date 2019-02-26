<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueStatus extends Model
{
    // Table Name
    protected $table ='venuestatus';

    // Primary Key
    public $primaryKey = 'venueStatusID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['venueStatusType'];


    public function venues(){
        return $this->belongsTo('App\Venues', 'venueStatusID');
    }

}
