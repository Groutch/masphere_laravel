<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Event;
use App\Model\User;
use App\Model\Guard;
use App\Model\Urequest;

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
        $urequest->statut=2;
        $urequest->save();
    	return redirect()->route('guard_details_pro', ['id' => $request->guard]);
    }

}