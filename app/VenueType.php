<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueType extends Model
{
    // Table Name
    protected $table ='venuetype';

    // Primary Key
    public $primaryKey = 'venueTypeID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['venueTypeName'];

    public function f_venueTypeVT()
    {
        return $this->belongsTo('App\Venue');
    }

}

