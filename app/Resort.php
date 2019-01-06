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
    public function trails()
    {
        return $this->hasMany('App\Trail');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }
}
