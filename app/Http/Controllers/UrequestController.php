<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Event;
use App\Model\User;
use App\Model\Guard;
use App\Model\Urequest;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class UrequestController extends Controller
{
    /**
     * Nothing
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Reject an urequest
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function reject(Request $request, $id)
    {
        $urequest=Urequest::find($id);
        $user_id=$urequest->user_id;
        $mail= User::find($user_id)->email;
        $objMail = new \stdClass();
        $objMail->valid = "Votre demande de guarde n'est pas acceptée";
        $objMail->sender = Auth::user()->name;
        $objMail->receiver = User::find($user_id)->name;
        Mail::to($mail)->send(new Email($objMail));
        $urequest->statut=1;
        $urequest->save();
    	return redirect()->route('guard_details_pro', ['id' => $request->input('guard')]);
    }
    /**
     * Accept an urequest
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function accept(Request $request, $id)
    {
        $urequest=Urequest::find($id);
        $user_id=$urequest->user_id;
        $mail= User::find($user_id)->email;
        $objMail = new \stdClass();
        $objMail->valid = "Votre demande de guarde est acceptée";
        $objMail->sender = Auth::user()->name;
        $objMail->receiver = User::find($user_id)->name;
        Mail::to($mail)->send(new Email($objMail));
        $urequest->statut=2;
        $urequest->save();
        //Mail::to("receiver@example.com")->send(new Email($objDemo));
    	return redirect()->route('guard_details_pro', ['id' => $request->guard]);
    }

}