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
