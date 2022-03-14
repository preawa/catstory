<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Catowner extends Model
{
    protected $fillable = ['user_id', 'name', 'body', 'address_address', 'latitude', 'longitude', 'slug', 'image', 'status', 'is_approved'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
}
