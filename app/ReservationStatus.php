<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
   // Table Name
    protected $table ='status';

    // Primary Key
    public $primaryKey = 'statusID';
    // Timestamps
    public $timestamps = false;

    // protected $fillable = [''];


    public function venues(){
        return $this->hasOne('App\Schedule', 'statusID');
    }

}