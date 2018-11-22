<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Event;
use App\Model\User;
use App\Model\Guard;
use App\Model\Urequest;
use Illuminate\Support\Facades\DB;


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
     * delete a urequest
     * @param integer $id
     * @return Response
     */
    public function delete($id)
    {
        $curr_user = Auth::User()->id;
        $req_garde= Guard::find($id);
        $req_ur=$req_garde->urequests[0];
        //dd($req_garde->user_id);
        //si l'utilisateur est le propriétaire de la demande
        if($req_ur->user_id == $curr_user){
            //suppression de la demande de garde
            $req_ur->delete();
            // il faut aller aussi dans la table "gard_user" pour tout bien supprimer
            DB::table('guard_user')->where([['user_id',  $curr_user],['guard_id',$req_garde->id]])->delete();
            return redirect('/profil/'.Auth::User()->id);
            
            
        }else{
            return redirect()->back()->withErrors(['Suppression impossible : Vous n\'avez pas fait cette demande.']);
        }
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
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("masphere@outlook.fr", "MaSphere");
        $email->setSubject("MaSphere : Demande de garde refusée");
        $email->addTo($mail, User::find($user_id)->name);
        $email->addContent("text/plain", "Votre demande de garde n'est pas acceptée");
        $email->addContent("text/html", "Votre demande de garde n'est pas acceptée");
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
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
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("masphere@outlook.fr", "MaSphere");
        $email->setSubject("MaSphere : Demande de garde acceptée");
        $email->addTo($mail, User::find($user_id)->name);
        $email->addContent("text/plain", "Votre demande de garde est acceptée");
        $email->addContent("text/html", "Votre demande de garde est acceptée");
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
        $urequest->statut=2;
        $urequest->save();
        //Mail::to("receiver@example.com")->send(new Email($objDemo));
    	return redirect()->route('guard_details_pro', ['id' => $request->guard]);
    }

}