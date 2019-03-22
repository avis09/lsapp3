<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice2 extends Model
{
    protected $table = 'practice';

    // Primary Key
    public $primaryKey = 'practiceID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['venue', 'name', 'time'];

}
