<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $fillable = ['user_id', 'name', 'body', 'latitude', 'longitude', 'image', 'is_approved'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
}
