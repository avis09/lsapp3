<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Table Name
    protected $table = 'feedbacks';

    // Primary Key
    public $primaryKey = 'feedbackID';
    // Timestamps
    public $timestamps = false;

    protected $fillable = ['venueID', 'userID', 'comment', 'create_at'];


    public function f_venue ()
    {
        return $this->belongsTo('App\Venue', 'venueID');
    }

    public function f_user()
    {
        return $this->belongsTo('App\User', 'userID');
    }


    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = \Carbon\Carbon::now();
    }
}