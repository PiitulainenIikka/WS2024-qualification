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

class EventController extends Controller
{


    public function __construct(Request $request) 
    {
    }

    public function show(Request $request)
    {
        $events = Event::where('organizer_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
        
        $data = [];

        foreach ($events as $event) 
        {
            $count = 0;
            $tickets = Event_tickets::where('event_id',$event->id)->get();
            foreach($tickets as $ticket){
                $registrations_count = Registrations::where('ticket_id',$ticket->id)->count();
                $count += $registrations_count;
            }
            $data[] = [
                'id' => $event->id,
                'name' => $event->name,
                'date' => $event->date,
                'registrations' => $count
            ];
        }
        return view('events.index',['events' => $data]);
    }

    public function showCreate() 
    {
        return view('events.create');
    }
    public function showEdit(Request $request)
    {
        $event_id = $request->event_id;

        $event = Event::find($event_id);

        return view('events.edit',[
            'event' => $event
        ]);
    }
    public function showSingle(Request $request)
    {
        $event_id = $request->event_id;

        $event = Event::find($event_id);
        $tickets = Event_tickets::where('event_id',$event_id)->get();
        $channels = Channels::where('event_id',$event_id)->get();
        $rooms = [];
        $sessions = [];
        foreach ($channels as $channel)
        {
            $rooms = Rooms::where('channel_id',$channel->id)->get();
            $channel->rooms_count = $rooms->count();
            foreach ($rooms as $room)
            {
                $sessions = Sessions::where('room_id',$room->id)
                    ->join('rooms', 'sessions.room_id','=','rooms.id')
                    ->select('sessions.type',
                            'sessions.*',
                            'rooms.name as room_name')
                    ->get();
                $channel->sessions_count = $sessions->count();
            }
        }   
        return view('events.detail',[
            'event' => $event,
            'tickets' => $tickets,
            'channels' => $channels,
            'rooms' => $rooms,
            'sessions' => $sessions
        ]);
    }

    public function create(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
    
        $event = [
            'name' => $request->name,
            'slug' => $request->name,
            'date' => $request->date,
            'organizer_id' => Auth::id()
        ];
        $event = new Event();
        $event->name = $request->name;
        $event->slug = $request->name;
        $event->date = $request->date;
        $event->organizer_id = Auth::id();
        $event->save();

        return redirect('/event/details/'. $event->id)->with('status', 'Event successfully created');
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
    
        $event = [
            'name' => $request->name,
            'slug' => $request->name,
            'date' => $request->date,
            'organizer_id' => Auth::id()
        ];
        $event = new Event();
        $event->name = $request->name;
        $event->slug = $request->name;
        $event->date = $request->date;
        $event->organizer_id = Auth::id();
        $event->save();

        return redirect('/events/details/'. $event->id)->with('status', 'Event succesfully edited');
    }

}
