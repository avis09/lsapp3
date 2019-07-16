<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservationsettings extends Model
{
    protected $primaryKey = "reservationSettingsID";
    protected $fillable = [
        'reservationSettingsID', 'startDate', 'endDate', 'userID', 'updated_at'
    ];

    public $timestamps = false;
    protected $table = 'Reservationsettings';


}
