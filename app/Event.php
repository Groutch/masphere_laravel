<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function users()
    {
        return $this->belongsToMany('\App\User');
    }

    public function guards()
    {
        return $this->belongsToMany('\App\Guard');
    }
}
