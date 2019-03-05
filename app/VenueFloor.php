<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueFloor extends Model
{
    protected $table ='venuefloor';
    protected $primaryKey = 'venueFloorID';

    protected $fillable = ['venueFloorID', 'venueFloorName'];

    public function building(){
    	return $this->hasOne('App/Building', 'venueFloorID');
    }

}
