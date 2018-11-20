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

class GuardController extends Controller
{

    /**
     * take the id of an event and an user (User::where('id', $id)) 
     * and return a boolean true if the concerned event is owned by the inline user.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifGuardOwner($guardId, $user)
    {
        $userGuardsIds = $user->guards->map(function($a){
            return $a->id;
        });
        return $userGuardsIds->contains($guardId);
    }

    /**
     * Display the specified user's guards.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new guard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $event = Event::All()->where("id", "=", $id)->first();

        $userName = Auth::User()->name;

        $usersNames = $event->guards->map(function($a){
            return $a->users[0]->name;
        });
        if($usersNames->contains($userName)){
            return redirect()->back()->withErrors(['vous êtes déjà inscrit sur cet événement']);
        }
            return view('sub_proguard_details', compact('event'));
    }

    /**
     * Store a newly created guard in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $userName = Auth::User()->name;
        $event = Event::All()->where("id", "=", $id)->first();

        $usersNames = $event->guards->map(function($a){
            return $a->users[0]->name;
        });
        if($usersNames->contains($userName)){
            return redirect()->back()->withErrors(['vous êtes déjà inscrit sur cet événement']);
        }

        function geocode($city){
            $fullurl = "https://koumoul.com/s/geocoder/api/v1/coord?q=". urlencode($city);
            $string = file_get_contents($fullurl); // get json content
            $geoloc = json_decode($string, true); //json decoder
            return ['lat' => $geoloc['lat'], 'long' => $geoloc['lon']];
        }

        $guard = new Guard;
        $guard->list_places = json_encode($request->list_places);
        $result_list_places = [];

        foreach ($request->list_places as $key => $place) {
            $geo = geocode($request->list_places[$key]);
            $lat = $geo['lat'];
            $long = $geo['long'];
            $result_list_places[] = [
            'place_id' => $key,
            'lat' => $lat,
            'long' => $long,
            'name' => $request->list_places[$key],
            'child_nb' => $request->list_child_nbs[$key],
            'range' => $request->list_range[$key],
            ];
        }
        $guard->list_places = json_encode($result_list_places);

        $guard->debut = strtotime($request->debutDate.' '.$request->debutHeure);
        $guard->fin = strtotime($request->finDate.' '.$request->finHeure);
        $guard->textbox = preg_replace("/\r\n|\r|\n/", '<br/>', $userName.'/'.$request->textbox.'/'.Auth::User()->id);

        if (true) {
            $guard->save();
            $user = Auth::User();
            $event = Event::All()->where("id", "=", $id)->first();
            $guard->events()->sync($event);
            $guard->users()->sync($user);
        }else{
            return redirect()->back()->withInput();
        }

        return redirect()->route('event_search');
    }

    /**
     * Remove the specified guard from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::User();
        $guard = Guard::All()->where("id", "=", $id)->first();

        if(!$this->verifGuardOwner($id, $user)){
            return redirect('/profil/'.$user->id);
        }

        $guard->users()->detach();

        if(false){
            $guard->delete();
        }
        return redirect('/profil/'.$user->id);
    }

    /**
     * Show the form used by procult for create a request on an guard.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProcult(Request $request, $id)
    {

        $guard = Guard::All()->where("id", "=", $id)->first();
        $userName = Auth::User()->name;

        $usersNames = $guard->users->map(function($a){
            return $a->name;
        });

        if($usersNames->contains($userName)){
            return redirect()->back()->withErrors(['vous êtes déjà inscrit sur cette garde']);
        }

        return view('sub_procult_details', compact('guard'));
    }

    /**
     * Store a newly created urequest in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProcult(Request $request, $id)
    {
        $user = Auth::User();
        $guard = Guard::All()->where('id', '=', $id)->first();
        $textbox = $guard->textbox;
        $idProGuard= explode("/", $textbox)[2];

        $mail= User::find($idProGuard)->email;
        $objMail = new \stdClass();
        $objMail->valid = $user->name." a envoyé une demande de garde pour l'event : ".$guard->events[0]->nom;
        $objMail->sender = "";
        $objMail->receiver = User::find($idProGuard)->name;
        Mail::to($mail)->send(new Email($objMail));

        $usersNames = $guard->users->map(function($a){
            return $a->name;
        });

        if($usersNames->contains($user->name)){
            return redirect()->back()->withErrors(['vous êtes déjà inscrit sur cette garde']);
        };

        function geocode($city){
            if ($city) {
                $fullurl = "https://koumoul.com/s/geocoder/api/v1/coord?q=". urlencode($city);
                $string = file_get_contents($fullurl); 
                $geoloc = json_decode($string, true); 
                return ['lat' => $geoloc['lat'], 'long' => $geoloc['lon']];
            }else{
                return ['lat' => null, 'long' => null];
            }

        }

        $user->guards()->sync($guard);

        $urequest = new Urequest;

        $geo = geocode($request->place);

        $lat = $geo['lat'];
        $long = $geo['long'];

        $urequest->place = $request->place?$request->place:$guard->list_places[0];
        $urequest->lat = $lat;
        $urequest->long = $long;
        $urequest->user_id = $user->id;

        $urequest->debut = strtotime($request->debutDate.' '.$request->debutHeure);
        $urequest->fin = strtotime($request->finDate.' '.$request->finHeure);
        $urequest->textbox = preg_replace("/\r\n|\r|\n/", '<br/>', $user->name.'/'.$request->textbox.'/'.$user->id);//

        $urequest->save();
        $urequest->guards()->sync($guard);

        return redirect()->route('event_search');
    }

    /**
     * Display the specified guards.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $guard = $request->user()->guards->where('id', '=', $id)->first();
        return view('guard_details_pro', compact('guard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProcult($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProcult(Request $request, $id)
    {
        //
    }
}
