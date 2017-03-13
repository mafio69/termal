<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Customer;
use App\Note;
use Illuminate\Validation\Rule;
use App\Status;
use App\Event;
use App\Person;
use App\Poject;


class CustomersController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($statuses_id = null)
    {
        if($statuses_id == null){
        $customer=Customer::where('id','<>',55)->orderBy('city','ASC')->get();
        $count = $customer->count()-1;
        $statuses = Status::orderBy('name')->get();
        $customers=Customer::with('status')->with('events')->where('id','<>',55)->orderBy('city','ASC')->paginate(20);
        $notes = Note::where('user_id',auth()->id())->get();
        }else{
        $customer=Customer::where('id','<>',55)->where('statuses_id',$statuses_id)->orderBy('city','ASC')->get();
        $count = $customer->count();
        $statuses = Status::orderBy('name')->get();
        $customers=Customer::with('status')->with('events')->where('id','<>',55)->where('statuses_id',$statuses_id)->orderBy('city','ASC')->paginate(20);
        $notes = Note::where('user_id',auth()->id())->get();
        }
        return view('customers.index', compact('customers','notes','count','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::get();
        $wojewodztwa = array(
            0=>'dolnośląskie',
            1=>'kujawsko-pomorskie',
            2=>'lubelskie',
            3=>'lubuskie',
            4=>'łódzkie',
            5=>'małopolskie',
            6=>'mazowieckie',
            7=>'opolskie',
            8=>'podkarpackie',
            9=>'podlaskie',
            10=>'pomorskie',
            11=>'śląskie',
            12=>'świętokrzyskie',
            13=>'warmińsko-mazurskie',
            14=>'wielkopolskie',
            15=>'zachodniopomorskie'
        );

        return view('customers.create',compact('statuses','wojewodztwa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'company' => 'required|min:3',
            'email' => 'required|email|unique:customers',
            'phone' => 'phone|unique:customers',
        ],[
                'required' => 'Pole :attribute jest wymagane.',
                'email' => 'Pole :attribute musi być poprawnym adresem email.',
                'unique' => 'Podany email jest już w bazie.',
                'min' => 'Nazwa firmy musi mieć minimum :min znaków',
            ]
        );
        $user=Customer::create([
            'company' => trim($request->company),
            'city' => trim($request->city),
            'nr' => trim($request->nr),
            'user_id'=> auth()->id(),
            'street' => trim($request->street),
            'zip_code' => trim($request->zip_code),
            'province' => trim($request->province),
            'phone_1' => trim($request->phone_1),
            'phone_2' => trim($request->phone_2),
            'phone_3' => trim($request->phone_3),
            'nip' => trim($request->nip),
            'web' => trim($request->web),
            'email' => trim($request->email),
            'statuses_id' => $request->statuses_id,
            'notes' => trim($request->notes),

        ]);

        return redirect('/klienci/'.$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $customer=Customer::with('person')->with('status')->find($id);
        $projects = Project::with('events')->where('customer_id',$id)->get();
        //var_dump($customer->status());
        $events = Event::with('event_type')->with('customer')->with('user')->with('person')->where('customer_id',$id)->orderBy('activ')->orderBy('event_data')->get();
        $notes = Note::where('customer_id',$customer->id)->where('user_id',auth()->id())->orderBy('created_at','desc')->limit(10)->get();
        
        return view('customers.show',compact('customer','notes','events','projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wojewodztwa = array(
            0=>'dolnośląskie',
            1=>'kujawsko-pomorskie',
            2=>'lubelskie',
            3=>'lubuskie',
            4=>'łódzkie',
            5=>'małopolskie',
            6=>'mazowieckie',
            7=>'opolskie',
            8=>'podkarpackie',
            9=>'podlaskie',
            10=>'pomorskie',
            11=>'śląskie',
            12=>'świętokrzyskie',
            13=>'warmińsko-mazurskie',
            14=>'wielkopolskie',
            15=>'zachodniopomorskie'
        );
        $statuses = Status::get();
        $customer=Customer::with('status')->find($id);
        return view('customers.edit',compact('customer','statuses','wojewodztwa'));
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
        $this->validate($request, [
            'company' => 'required|min:3',
            'email' => ['required', 'email', 'max:125', Rule::unique('customers')->ignore($id)],
        ],[
                'required' => 'Pole :attribute jest wymagane.',
                'email' => 'Pole :attribute musi być poprawnym adresem email.',
                'unique' => 'Podany email jest już w bazie.',
                'min' => 'Nazwa firmy musi mieć minimum :min znaków',
            ]
        );

        Customer::where('id', $id)->update([
            'user_id' => auth()->id(),
            'company' => $request->company,
            'city' => $request->city,
            'nr' => $request->nr,
            'street' => $request->street,
            'zip_code' => $request->zip_code,
            'province' => $request->province,
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'phone_3' => $request->phone_3,
            'nip' => $request->nip,
            'web' => $request->web,
            'email' => $request->email,
            'statuses_id' => $request->statuses_id,
            'notes' => $request->notes,
        ]);

        return redirect('/klienci/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer =Customer::find($id);
        $customer->delete();
        Note::where('customer_id',$id)->where('user_id',auth()->id())->delete();
        Person::where('customer_id',$id)->delete();
        Event::where('customer_id',$id)->delete();
        session()->flash('flash_message', 'Klient został usunięty , wraz z wszytkimi danymi o nim!');
        return redirect('/klienci-status');
    }
}
