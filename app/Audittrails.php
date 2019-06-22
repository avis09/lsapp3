<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audittrails extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'userID', 'activity', 'created_at'
    ];

    protected $table = 'audittrails';

    public function users()
    {
        return $this->belongsTo('App\User', 'userID');
    }

}
