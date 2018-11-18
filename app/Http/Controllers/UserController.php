<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Event;
use App\Model\User;
use App\Model\Guard;
use App\Model\Urequest;

class UserController extends Controller
{
	/**
     * Edit users information 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function edit()
	{
		$user=Auth::user();
		return view('edit_user',compact('user'));
	}
	/**
     * Edit users information 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function submit(Request $request)
	{
		$current=Auth::user();
		$user=User::find($current->id);
		$user->name=$request->name;
		$user->email=$request->email;
		if(strlen($request->newpass)>7){
			$user->password=$request->newpass;
		}
		$user->save();
		return redirect()->route('edit_account');
	}
}