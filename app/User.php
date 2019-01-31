<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "userID";

    public $timestamps = false;

    protected $fillable = [
        'userRoleID', 'firstName', 'LastName', 'userStatusID', 'Password', 'phoneNumber', 'email', 'apiToken', 'departmentID', 'IDnumber'
    ];

//    public function f_classrooms(){
//        return $this->hasMany('App\Classroom', 'roomID');
//    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//
//    public function posts(){
//        return $this->hasMany('App\Post');
//    }


 public function f_userrole(){
     return $this->belongsTo('App\UserRole', 'userRoleID');
 }
    public function f_userstatus(){
        return $this->belongsTo('App\UserStatus', 'userStatusID');
    }
    public function f_department(){
        return $this->belongsTo('App\Department', 'departmentID');
    }
}
