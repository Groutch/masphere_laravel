<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

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
        // if (Auth::user()->roles->implode('slug')=='procult') {
        //     return Redirect()->route('procult');
        // } else if (Auth::user()->roles->implode('slug')=='proguard'){
        //     return Redirect()->route('proguard');
        // } else if (Auth::user()->roles->implode('slug')=='orga'){
        //     return Redirect()->route('orga');
        // } else if (Auth::user()->roles->implode('slug')=='admin'){
        //     return Redirect()->route('admin');
        // }
        if(Auth::user()->roles->implode('slug')=='orga'){
            return redirect('/event_list_orga');
        } elseif (Auth::user()->roles->implode('slug')=='procult') {
            return redirect('/event_list_procult');
        } elseif (Auth::user()->roles->implode('slug')=='proguard') {
            return redirect('/event_list_proguard');
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
