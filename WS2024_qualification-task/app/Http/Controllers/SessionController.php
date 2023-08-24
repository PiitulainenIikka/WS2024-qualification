<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use App\Models\Event;
use App\Models\Event_tickets;
use App\Models\Registrations;
use App\Models\Rooms;
use App\Models\Sessions;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{


    public function __construct(Request $request) 
    {
    }


    public function showCreate(Request $request) 
    {
        
        $event_id = $request->event_id;
        $event = Event::find($event_id);

        return view('sessions.create',[
            'event' => $event
        ]);
    }
    public function showEdit(Request $request)
    {
        
        $event_id = $request->event_id;
        $event = Event::find($event_id);

        return view('sessions.edit',[
            'event' => $event
        ]);
    }

    public function create(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'title' => 'required',
            'speaker' => 'required',
            'room' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        $event = Event::find($request->event_id);

        if($event === null){
            return Redirect::back()->withErrors(['missing']);
        }

        $session = new Sessions();
        $session->title= $request->title;
        $session->description = $request->description;
        $session->speaker = $request->speaker;
        $session->start = $request->start;
        $session->end = $request->end;
        $session->type = $request->type;
        $session->room_id = $request->room;
        if($request->cost){
            $session->cost = $request->cost;
        }

        $session->save();

        return redirect('/events/details/'. $event->id)->with('status', '"Session successfully created');
    }
    public function edit()
    {

    }

}
