<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Urequest extends Model
{
    /*
     *
     * link function to link Guard
     *
     */
    public function guards()
	{
		return $this->belongsToMany('App\Model\Guard');
    }
    public function user()
    {
        return $this->hasOne('App\Model\User');
    }
}