<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Role;
use App\Model\Event;
use App\Model\Urequest;
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
        if(Auth::User() && Auth::User()->roles[0]->id==3){
            return redirect('profil/'.Auth::User()->id);
        }
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
                array_push($tab,$ureq->guards[0]->events[0]);
            }
            $tab=array_unique($tab);
            return view('event_list_proguard',compact('infoUser','roleName','guards','tab'));
        }
    }

}
