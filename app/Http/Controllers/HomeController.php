<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Role;
use App\Model\Event;
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getUsers($id){
        $infoUser = User::find($id);
        $roleName = $infoUser->roles->implode('name');
        $events = $infoUser->events;
        $guards= $infoUser->guards;
        if($roleName=="organisateur"){
            return view('event_list_orga',compact('infoUser','roleName','events'));
        }else{
            $urequests=$infoUser->urequests;
            $tab= [];
            foreach($urequests as $ureq){
                array_push($tab,$ureq->guards[0]->events[0]->id);

            }
            dd($tab);
            //return view('event_list_proguard',compact('infoUser','roleName','guards'));
        }
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
