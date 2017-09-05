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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        return Auth::user()->roles->implode('slug');
    }
    
    public function procult()
    {
        return 'procult'.Auth::user()->roles->implode('slug');
    }
    public function progard()
    {
        return 'progard'.Auth::user()->roles->implode('slug');
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
