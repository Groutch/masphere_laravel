<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Event;
use App\Model\Guard;
use App\Model\Urequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected function authenticated()
    {
        //requete qui supprimera les évènements/garde/demande de garde plus anciennes qu'aujourd'hui à la connexion
        $events=Event::All();
        //pour chaque event
        foreach ($events as $event){
            if (intval($event->fin) < time()){
                //s'il y a des gardes
                $guards = $event->guards;
                if(isset($guards[0]->id)){
                    //pour chaque garde de l'event
                    foreach ($guards as $guard){
                        // s'il y a des urequest
                        if(isset($guard->urequests[0]->id)){
                            foreach($guard->urequests as $u){
                                Urequest::where('id',$u->id)->delete();
                            }
                            DB::table('guard_urequest')->where('guard_id',$guard->id)->delete();
                            DB::table('guard_user')->where('guard_id',$guard->id)->delete();
                            $guard->delete();
                        }
                        
                    }
                }
                Event::where('id',$event->id)->delete();
                DB::table('event_user')->where('event_id',$event->id)->delete();
            }
            
        }
        if(Auth::user()->roles->implode('slug')=='orga'){
            return redirect('/profil/'.Auth::user()->id);
        } elseif (Auth::user()->roles->implode('slug')=='procult') {
            return redirect('/profil/'.Auth::user()->id);
        } elseif (Auth::user()->roles->implode('slug')=='proguard') {
            return redirect('/profil/'.Auth::user()->id);
        }
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
