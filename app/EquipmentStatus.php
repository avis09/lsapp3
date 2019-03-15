<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentStatus extends Model
{
    // Table Name
    protected $table ='equipmentstatus';

    // Primary Key
    public $primaryKey = 'equipmentStatusID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['equipmentStatusName'];

    public function f_equipment()
    {
        return $this->hasMany('App\Equipment', 'equipmentStatusID');
    }
}
