<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table ='picture';

    protected $primaryKey = "pictureID";

    public $timestamps = false;

    protected $fillable = [
        'venueID', 'pictureName ', 'created_at'
    ];

    public function f_venue()
    {
        return $this->hasMany('App\Venue', 'venueID');
    }
}