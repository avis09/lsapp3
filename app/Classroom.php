<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    // Table Name
    protected $table ='classroomtest';

    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'place'];
}
