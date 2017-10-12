<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\User;
use App\Guard;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('event_creation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$event = new Event;
    	$event->nom = $request->nom;
    	$debut = strtotime($request->debutDate.' '.$request->debutHeure);
    	$fin = strtotime($request->finDate.' '.$request->finHeure);


    	$event->debut = strtotime($request->debutDate.' '.$request->debutHeure);
    	$event->fin = strtotime($request->finDate.' '.$request->finHeure);
    	$event->stylemusical = $request->stylemusical;
    	$event->billetterie = $request->billetterie;
        $event->textbox = preg_replace("/\r\n|\r|\n/", '<br/>', $request->textbox);
        $event->list_performs = json_encode($request->list_performs);
        // $event->duration = $event->fin - $event->debut;
        // dd(json_encode($request->list_performs));

        if($event->debut < $event->fin){
            $event->save();
            $user = Auth::User();
            $event->users()->sync($user);

            return redirect()->route('event_list_orga');
        }
        return back()->withInput();

        // $user->events()->sync($event);
        // $event->users()->sync($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showorga($id)
    {
        $event = Event::All()->where("id", "=", $id)->first();
        return view('event_details_orga', compact('event'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showproguard($id)
    {
        $event = Event::All()->where("id", "=", $id)->first();

        return view('event_details_proguard', compact('event'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showprocult($id)
    {
        $event = Event::All()->where("id", "=", $id)->first();
        $guards = $event->guards->map(function($a){
            $decoded_list_places = json_decode($a->list_places);
            $a->list_places = $decoded_list_places;
            return $a;
        });
        return view('event_details_procult', compact('event', 'guards'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userall(Request $request)
    {
        $events = $request->user()->events;
        return view('event_list_orga', compact('events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $events = Event::all();
        $guards_nb = Event::all()->map(function($event){
            // dump(count($event->guards));
            return count($event->guards);
        });

        // dd($guards_nb);
        return view('event_search', compact('events', 'guards_nb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SubProGuardDetails(Request $request, $id)
    {
        // dump($request);
        $event = Event::All()->where("id", "=", $id)->first();
        return view('sub_proguard_details', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SubProGuard(Request $request, $id)
    {
        $guard = new Guard;
        $guard->list_places = json_encode($request->list_places);
        $guard->list_child_nbs = json_encode($request->list_child_nbs);
        $guard->list_range = json_encode($request->list_range); // rayon autour du quel le pro peut garder.

        $guard->debut = strtotime($request->debutDate.' '.$request->debutHeure);
        $guard->fin = strtotime($request->finDate.' '.$request->finHeure);
        $guard->textbox = preg_replace("/\r\n|\r|\n/", '<br/>', $request->textbox);

        $guard->save();
        $user = Auth::User();
        $event = Event::All()->where("id", "=", $id)->first();
        $guard->events()->sync($event);
        // $event->guards()->sync($guard);
        $guard->users()->sync($user);
        // $user->events()->sync($event);
        // $event->users()->sync($event);

        return redirect()->route('event_list_proguard');
        // return redirect()->route('event_search');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
