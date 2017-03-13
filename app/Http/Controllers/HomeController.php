<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Event;
use App\Note;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $projects = Project::with('customer')
                ->with('user')
                ->with('events')
                ->with('events.user')
                ->with('events.person')
                ->with('events.customer')
                ->with('events.event_type')
                ->where('not_activ', null)
                ->orderBy('created_at')
                ->paginate(40);
        $events = Event::whereDate('event_data','<=',date("Y-m-d"))
        		->where('activ',null)
        		->where('user_id',auth()->id())
                ->with('customer')
                ->with('event_type')
                ->with('user')
                ->with('person')
                ->orderBy('activ')
                ->orderBy('event_data')
                ->get();
        $notes = Note:: where('user_id',auth()->id())
        	    //whereDate('created_at', '>', date("Y-m-d", strtotime("-7day")))
        		->where('user_id',auth()->id())
                ->orderBy('created_at','desc')
                ->with('customer')
                ->limit(5)
                ->get();
        return view('home', compact('projects', 'events', 'notes'));
    }

     public function teraz() {
        $projects = Project::with('customer')
        		->whereDate('updated_at',date('Y-m-d'))
                ->with('user')
                ->with('events')
                ->with('events.user')
                ->with('events.person')
                ->with('events.customer')
                ->with('events.event_type')
                ->where('not_activ', null)
                ->orderBy('created_at')
                ->paginate(40);
        $events = Event::whereDate('updated_at',date('Y-m-d'))
        		->where('user_id',auth()->id())
                ->with('customer')
                ->with('event_type')
                ->with('user')
                ->with('person')
                ->orderBy('activ')
                ->orderBy('event_data')
                ->get();
        $notes = Note:: where('user_id',auth()->id())
        	    //whereDate('created_at', '>', date("Y-m-d", strtotime("-7day")))
        		->whereDate('updated_at',date('Y-m-d'))
        		->orderBy('created_at','desc')
                ->with('customer')
                ->limit(5)
                ->get();  

                 $now=1;
        return view('home', compact('projects', 'events', 'notes','now'));
    }

}
