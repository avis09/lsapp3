<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    // Table Name
    protected $table ='building';

    // Primary Key
    public $primaryKey = 'buildingID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['buildingName'];

    public function f_venueB(){
        return $this->hasMany('App\Venue');
}
}
