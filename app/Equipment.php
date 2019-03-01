<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table ='equipment';

    protected $primaryKey = "equipmentID";

    public $timestamps = false;

    protected $fillable = [
        'venueID', 'equipmentStatusID', 'equipmentName',  'barCode','created_at', 'updated_at'
    ];

    public function f_venue()
    {
        return $this->belongsTo('App\Venue', 'venueID');
    }
    public function f_equipmentStatus()
    {
        return $this->belongsTo('App\EquipmentStatus', 'equipmentStatusID');
    }
}
