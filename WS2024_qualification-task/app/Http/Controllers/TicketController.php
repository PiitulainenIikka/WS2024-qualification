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

class TicketController extends Controller
{


    public function showCreate(Request $request) 
    {

        $event_id = $request->event_id;
        $event = Event::find($event_id);

        return view('tickets.create',[
            'event' => $event
        ]);
    }
 

    public function create(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cost' => 'required|int',
            'special_validity' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        
        $event = Event::find($request->event_id);
        if($event === null){
            return Redirect::back()->withErrors(['error' => 'Event not found']);
        }
        
        if($request->special_validity == 'date'){
            if(!$request->valid_until){
                return Redirect::back()->withErrors(['date' => 'missing']);
            }

            $special_validity = json_encode([
                'type' => 'date',
                'date' => $request->valid_until
            ]);
        }
        if($request->special_validity == 'amount') {
            if(!$request->amount){
                return Redirect::back()->withErrors(['amount' => 'missing']);
            }
            $special_validity = json_encode([
                'type' => 'amount',
                'amount' => $request->amount
            ]);
        }
    
        $data = [
            'event_id' => $request->event_id,
            'name' => $request->name,
            'cost' => $request->cost,
            'special_validity' => $special_validity
        ];
       
        $event_ticket = new Event_tickets();
        $event_ticket->event_id = $request->event_id;
        $event_ticket->name = $request->name;
        $event_ticket->cost = $request->cost;
        $event_ticket->special_validity = $special_validity;
        $event_ticket->save();

        return redirect('events/details/'.$event->id)->with('status', 'Event ticket created succesfully');
    }
    public function edit()
    {

    }

}
