<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Role;
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
    public function getUsers($id){
        $infoUser = User::All()->where('id',$id)->first();
        $roleName = $infoUser->roles->implode('name');
        
        return view('dashboard', compact('infoUser','roleName'));
        
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
