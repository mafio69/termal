<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Note;
use Illuminate\Validation\Rule;

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
    public function index()
    {
        $customer=Customer::orderBy('city','ASC')->get();
        $count = $customer->count()-1;
        $customers=Customer::orderBy('city','ASC')->paginate(20);
        $notes = Note::all();

        return view('customers.index', compact('customers','notes','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view ('customers.create');
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
        ],[
                'required' => 'Pole :attribute jest wymagane.',
                'email' => 'Pole :attribute musi być poprawnym adresem email.',
                'unique' => 'Podany email jest już w bazie.',
                'min' => 'Nazwa firmy musi mieć minimum :min znaków',
            ]
        );
        Customer::create([
            'company' => trim($request->company),
            'city' => trim($request->city),
            'nr' => trim($request->nr),
            'street' => trim($request->street),
            'zip_code' => trim($request->zip_code),
            'province' => trim($request->province),
            'phone_1' => trim($request->phone_1),
            'phone_2' => trim($request->phone_2),
            'phone_3' => trim($request->phone_3),
            'nip' => trim($request->nip),
            'web' => trim($request->web),
            'email' => trim($request->email),
            'person_id' => $request->person,
            'notes' => trim($request->notes),

        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer=Customer::with('person')->find($id);
        $notes = Note::where('customer_id',$customer->id)->orderBy('created_at','desc')->limit(10)->get();
        
        return view('customers.show',compact('customer','notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer=Customer::find($id);
        return view('customers.edit',compact('customer'));
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
            'person_id' => $request->person,
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
        Note::where('customer_id',$id)->delete();
        return redirect('/klienci');
    }
}
