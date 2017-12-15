<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $hidden = ['id'];
	
	/*
	 *
	 * link function to link Users
	 *
	 */
    public function users()
    {
        return $this->belongsToMany('\App\Model\User');
    }
	
	/*
	 *
	 * link function to link Guards
	 *
	 */
    public function guards()
    {
        return $this->belongsToMany('\App\Model\Guard');
    }
}
