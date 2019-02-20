<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Table Name
    protected $table ='department';

    // Primary Key
    public $primaryKey = 'departmentID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['departmentName'];

    public function f_userD(){
        return $this->hasMany('App\User');
    }
}
