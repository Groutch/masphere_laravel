<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urequest extends Model
{
    
    public function guards()
	{
		return $this->belongsToMany('App\Guard');
	}
}
