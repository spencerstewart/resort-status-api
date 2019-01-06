<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function resort()
    {
        return $this->belongsTo('App\Resort');
    }
}
