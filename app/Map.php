<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = ['user_id', 'title', 'address_address', 'latitude', 'longitude','is_approved'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
}
