<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $fillable = ['cat_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cats()
    {
        return $this->belongsTo('App\Cat');
    }

}
