<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{

    public function showCreate(Request $request) 
    {
        $event_id = $request->event_id;
        $event = Event::find($event_id);

        return view('channels.create',[
            'event' => $event
        ]);
    }

    public function create(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }

        $event_id = $request->event_id;
        $event = Event::find($event_id);

        if($event == null){
            return Redirect::back()->withErrors(['missing']);
        }

        $channel = new Channels();
        $channel->event_id = $event_id;
        $channel->name = $request->name;
        $channel->save();

        return redirect('/events/details/'. $event->id)->with('status', '"Channel successfully created');

    }

}
