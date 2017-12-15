<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    protected $hidden = ['id'];
    
    /*
     *
     * link function to link Events
     *
     */
	public function events()
    {
        return $this->belongsToMany('\App\Model\Event');
    }
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
     * link function to link Requests
     *
     */
    public function urequests()
	{
		return $this->belongsToMany('App\Model\Urequest');
	}
}
