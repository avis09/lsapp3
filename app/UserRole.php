<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    // Table Name
    protected $table ='userrole';

    // Primary Key
    public $primaryKey = 'userRoleID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['roleType'];

    public function f_userR()
    {
        return $this->hasMany('App\User');
        }
}

