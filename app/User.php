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
        'userRoleID', 'firstName', 'LastName', 'userStatusID', 'password', 'phoneNumber', 'email', 'apiToken', 'departmentID', 'IDnumber'
    ];

    protected $table = 'users';

    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }

//    public function f_classrooms(){
//        return $this->hasMany('App\Classroom', 'roomID');
//    }
//    public function setPasswordAttribute($pass){
//
//        $this->attributes['password'] = Hash::make($pass);
//
//    }

//    public function getAuthIdentifier() {
//        return $this->getKey();
//    }
//    public function getAuthPassword()
//    {
//        return $this->password;
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
    public function f_venueType()
    {
        return $this->hasMany('App\Venue', 'venueID');
    }
    public function f_logTime()
    {
        return $this->hasMany('App\LogTime');
    }

    public function f_feedbacks()
    {
        return $this->hasMany('App\Feedbacks', 'userID');
    }
}
