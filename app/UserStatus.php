<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    // Table Name
    protected $table ='userstatus';

    // Primary Key
    public $primaryKey = 'userStatusID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['userStatusType'];

    public function f_userS()
    {
        return $this->hasMany('App\User');
    }
}
