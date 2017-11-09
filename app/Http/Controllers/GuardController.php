<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\User;
use App\Guard;
use App\Urequest;

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
    	$guards = $request->user()->guards;

    	return view('event_list_proguard', compact('guards'));
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
            // return redirect()->back()->withMessage('Deja inscrit ');
            return redirect()->back()->withErrors(['vous êtes déjà inscrit sur cet événement']);
        }

        // if(){
            return view('sub_proguard_details', compact('event'));
        // }
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
            // return redirect()->back()->withMessage('Deja inscrit ');
            return redirect()->back()->withErrors(['vous êtes déjà inscrit sur cet événement']);
        }

        function geocode($city){
            $fullurl = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($city) . "&lang=fr&key=AIzaSyBoZgHPmD27VzTcCSz4UlSm32GqtfYLsuk";
            $string = file_get_contents($fullurl); // get json content
            $geoloc = json_decode($string, true); //json decoder

            $coords = $geoloc['results'][0]['geometry']['location'];
            // $lat = $coords['lat'];
            // $long = $coords['long'];
            return ['lat' => $coords['lat'], 'long' => $coords['lng']];
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
        $guard->textbox = preg_replace("/\r\n|\r|\n/", '<br/>', $request->textbox);

        // $userId = Auth::User()->id;

        if (true) {
            // dd($guard);
            $guard->save();
            $user = Auth::User();
            $event = Event::All()->where("id", "=", $id)->first();
            $guard->events()->sync($event);
            // $event->guards()->sync($guard);
            $guard->users()->sync($user);
            // $user->events()->sync($event);
            // $event->users()->sync($event);
        }else{
            return redirect()->back()->withInput();
        }

        return redirect()->route('event_list_proguard');
        // return redirect()->route('event_search');
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
            return redirect('/event_list_proguard');
        }

        $guard->users()->detach();

        if(false){
            $guard->delete();
        }
        return redirect('/event_list_proguard');
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
            // return redirect()->back()->withMessage('Deja inscrit ');
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

        $usersNames = $guard->users->map(function($a){
            return $a->name;
        });

        if($usersNames->contains($user->name)){
            return redirect()->back()->withErrors(['vous êtes déjà inscrit sur cette garde']);
        };

        function geocode($city){
            if ($city) {
                $fullurl = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($city) . "&lang=fr&key=AIzaSyBoZgHPmD27VzTcCSz4UlSm32GqtfYLsuk";
                $string = file_get_contents($fullurl); // get json content
                $geoloc = json_decode($string, true); //json decoder

                $coords = $geoloc['results'][0]['geometry']['location'];
                // $lat = $coords['lat'];
                // $long = $coords['long'];
                return ['lat' => $coords['lat'], 'long' => $coords['lng']];
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
        $urequest->textbox = preg_replace("/\r\n|\r|\n/", '<br/>', $request->textbox);

        $urequest->save();
        $urequest->guards()->sync($guard);

        // $guard->urequests()->sync($urequest);

        return redirect()->route('event_list_procult');
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
