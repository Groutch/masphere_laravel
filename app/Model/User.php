<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     *
     * link function to link Event
     *
     */
    public function events()
    {
        return $this->belongsToMany('\App\Model\Event');
    }

    /*
     *
     * link function to link Role
     *
     */
    public function roles()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    /*
     *
     * link function to link Guard
     *
     */
    public function guards()
    {
        return $this->belongsToMany('App\Model\Guard');
    }
    public function urequests()
    {
        return $this->hasMany('App\Model\Urequest');
    }

}
