<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('event_search');
    }
    /**
     * Display the specified user's information.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers($name){
        return Auth::user();
    }
    public function procult()
    {
        return 'procult'.Auth::user()->roles->implode('slug');
    }
    public function proguard()
    {
        return 'proguard'.Auth::user()->roles->implode('slug');
    }
    public function orga()
    {
        return;
    }
    public function admin()
    {
        return 'role : '.Auth::user()->roles->implode('slug');
    }

}
