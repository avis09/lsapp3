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

    public $timestamps = true;

    protected $fillable = [
        'dateAdded', 'venueID', 'pictureName'
    ];

    public function f_venue()
    {
        return $this->belongsTo('App\Venue', 'venueID');
    }
}