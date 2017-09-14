<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\User;
use App\Guard;

class GuardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guards = $request->user()->guards;
        $events = [];
        foreach ($guards as $key => $guard) {
                $events[$key] = $guard->events[0]->nom;
        }
        return view('event_list_proguard', compact('guards', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        // dump($request);
        $event = Event::All()->where("id", "=", $id)->first();
        return view('sub_proguard_details', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $guard = $request->user()->guards->where('id', '=', $id)->first();
        return view('guard_details_proguard', compact('guard'));
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
