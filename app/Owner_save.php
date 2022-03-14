<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner_save extends Model
{
    protected $fillable = ['cat_id', 'cat_by', 'report_by', 'is_approved'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
    public function cats()
    {
        return $this->belongsTo('App\Cat');
    }
}
