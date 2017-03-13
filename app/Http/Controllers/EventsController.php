<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Event;
use App\person;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licznik = Event::where('activ' , null)->where('user_id',auth()->id())->count();
        if(auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'moderator' ){
         $events = Event::with('event_type')
                 ->with('customer')
                 ->with('user')
                 ->with('person')
                 ->where('event_data','>',date('Y-m-d',strtotime("-14 day")))
                 ->orderBy('activ')
                 ->orderBy('event_data')
                 ->paginate(40);   
        }else{
        $events = Event::with('event_type')
                ->where('user_id',auth()->id())
                ->with('customer')->with('user')
                ->with('person')->where('event_data','>',date('Y-m-d',strtotime("-14 day")))
                ->orderBy('activ')
                ->orderBy('event_data')
                ->paginate(40);
        }
        return view('events.index',compact('events','licznik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $customer = \App\customer::with('person')->findOrFail($id);
        $events = \App\EventType::all();
        return view('events.create', compact('customer','events'));
    }
    public function createProject($consumer_id,$project_id)
    {
        $customer = \App\customer::with('person')->findOrFail($consumer_id);
        $events = \App\EventType::get();
        $project_id = $project_id;
        return view('events.create', compact('customer','events','project_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $niceNames = [  //nazwy dla pól formularza
            'date' => 'data',
            'time' => 'czas',
            'title'=> 'tytuł',
            'description'=> 'opis',
            'event_type_id' => 'typ zdarzenia'
        ];
        $rules = [  //zasady walidacji
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'title'=> 'required|min:3',
            'description'=> 'required|min:5',
            'event_type_id' =>'required',
        ];
        $message =[ //wiadomości wyswietlane
            'required' => 'Pole :attribute jest wymagane.',
            'date_format:H:i' => "Godzina ma nie prawidłowy format. format to: GG:MM",
            'min' => 'Pole :attribute  musi mieć minimum :min znaków.',
            'date' => 'Pole :attribute musi być poprawną data: RRRR-MM-DD.',
            'time' => 'Pole :attribute musi być poprawnym czasem: GG:MM.'
        ];
        $this->validate($request, $rules, $message, $niceNames);
        Event::create([
           'event_type_id' => $request->event_type_id,
           'customer_id' => $request->customer_id,
           'person_id' => $request->person_id,
           'user_id' => auth()->id(),
           'project_id' => $request->project_id,
           'phone' => $request->phone,  
           'email' => $request->email,
           'event_data' => $request->date.' '.$request->time.':00', 
           'title' => $request->title,
           'description' => $request->description,
        ]);
        $request->session()->flash('flash_message', 'Zdarzenie zostało dodane!');
        return redirect('/klienci/'.$request->customer_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event =Event::with('customer')
                ->with('event_type')
                ->where('id',$id)
                ->first();
        $events = \App\EventType::get();

        return view('events.edit',compact('event','events'));
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
         $niceNames = [  //nazwy dla pól formularza
            'date' => 'data',
            'time' => 'czas',
            'title'=> 'tytuł',
            'description'=> 'opis',
            'event_type_id' => 'typ zdarzenia'
        ];
        $rules = [  //zasady walidacji
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'title'=> 'required|min:3',
            'description'=> 'required|min:5',
            'event_type_id' =>'required',
        ];
        $message =[ //wiadomości wyswietlane
            'required' => 'Pole :attribute jest wymagane.',
            'date_format:H:i' => "Godzina ma nie prawidłowy format. format to: GG:MM",
            'min' => 'Pole :attribute  musi mieć minimum :min znaków.',
            'date' => 'Pole :attribute musi być poprawną data: RRRR-MM-DD.',
            'time' => 'Pole :attribute musi być poprawnym czasem: GG:MM.'
        ];
        $this->validate($request, $rules, $message, $niceNames);

        Event::where('id',$id)->update([
           'event_type_id' => $request->event_type_id,
           'customer_id' => $request->customer_id,
           'person_id' => $request->person_id,
           'user_id' => auth()->id(),
            //'project_id' => $request->project_id,
           'phone' => $request->phone,  
           'email' => $request->email,
           'event_data' => $request->date.' '.$request->time.':00', 
           'title' => $request->title,
           'activ' => $request->activ,
           'description' => $request->description,
        ]);
        $request->session()->flash('flash_message', 'Zdarzenie zostało uaktualnine!');
        return redirect('/zdarzenie');
    }
    public function update_description(Request $request, $id) {
      $event=Event::findOrFail($id);
        $event->activ = $request->activ;
        $event->event_data = $request->date.' '.$request->time.':00';
        $event->description = $request->description;
        $event->save();
        session('flash_message','Wpis poprawiony');
        return back();  
    }
     public function off(Request $request, $id)
    {
        $event=Event::findOrFail($id);
        $event->activ = $request->activ;
        $event->save();
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
    }
    public function showDate(Request $request) {
         $licznik = Event::whereDate('event_data', $request->date)->where('user_id',auth()->id())->count();
        if(auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'moderator' ){
         $events = Event::
                   whereDate('event_data', $request->date)
                 ->with('event_type')
                 ->with('customer')
                 ->with('user')
                 ->with('person')
                 ->orderBy('activ')
                 ->orderBy('event_data')
                 ->paginate(40);  
                 $data=$request->date;  
        }else{
        $events = Event::
                  whereDate('event_data', $request->date)
                ->where('user_id',auth()->id())
                ->with('event_type')
                 ->with('customer')
                 ->with('user')
                 ->with('person')
                 ->orderBy('activ')
                 ->orderBy('event_data')
                 ->paginate(40);  
                  $data=$request->date; 
        }
        return view('events.lista',compact('events','licznik','data'));
   
    }
     public function tomorrow() {
        $data=date('Y-m-d',strtotime("+1 day"));
         $licznik = Event::whereDate('event_data', $data)->where('user_id',auth()->id())->count();
        if(auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'moderator' ){
         $events = Event::
                whereDate('event_data',$data)
                 ->with('event_type')
                 ->with('customer')
                 ->with('user')
                 ->with('person')
                 ->orderBy('activ')
                 ->orderBy('event_data')
                 ->paginate(40);  

        }else{
        $events = Event::
                    whereDate('event_data',$data)
                ->where('user_id',auth()->id())
                ->with('event_type')
                 ->with('customer')
                 ->with('user')
                 ->with('person')
                 ->orderBy('activ')
                 ->orderBy('event_data')
                 ->paginate(40);  
        }
        return view('events.lista',compact('events','licznik','data'));
   
    }
}
