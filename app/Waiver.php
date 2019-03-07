<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waiver extends Model
{
    protected $table ='waiver';

    protected $primaryKey = "waiverID";

    public $timestamps = false;

    protected $fillable = [
        'scheduleID', 'studentName', 'studentIDnumber'
    ];

    public function f_schedule()
    {
        return $this->belongsTo('App\Schedule', 'scheduleID');
    }
}
