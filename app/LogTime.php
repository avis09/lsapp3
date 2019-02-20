<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTime extends Model
{
    protected $primaryKey = "logTimeID";

    public $timestamps = false;

    protected $fillable = [
        'userID', 'inTime', 'outTime'
    ];

    protected $table = 'logtime';
}
