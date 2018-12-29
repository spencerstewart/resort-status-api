<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function chairs()
    {
        return $this->hasMany('App\Chair');
    }
}
