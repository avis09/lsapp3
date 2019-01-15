<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    // Table Name
    protected $table ='venuetest';

    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
     public $timestamps = false;

    protected $fillable = ['name', 'description', 'place'];

}
