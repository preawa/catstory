<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = ['user_id', 'title', 'address_address', 'latitude', 'longitude'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
