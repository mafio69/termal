<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Person;
use Illuminate\Validation\Rule;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Person::with('customer')->get()->count();
        $people = Person::with('customer')->paginate(20);
       
       return view('person.index', compact('people', 'count')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($customer_id)
    {
        $customer= Customer::findOrFail($customer_id);
        return view('person.create',compact('customer'));
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
            'imie' => 'required|min:3',
            'nazwisko' => 'required|min:3',
            'email' => 'required|email',
        ], [
                'required' => 'Pole :attribute jest wymagane.',
                'email' => 'Pole :attribute musi być poprawnym adresem email.',
                'unique' => 'Podany email jest już w bazie.',
                'min' => 'Nazwa firmy musi mieć minimum :min znaków',
            ]
        );

          Person::create([
            'customer_id' => $request->customer_id,
            'imie' => $request->imie,
            'nazwisko' => $request->nazwisko,
            'position' => $request->position,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'description' => $request->description,
            'address' => $request->address,
            'email' => $request->email,
            
        ]);
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
         $person = Person::with('customer')->findOrFail($id);

        return view('person.show', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::with('customer')->findOrFail($id);

        return view('person.edit',compact('person'));
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
            'imie' => 'required|min:3',
            'nazwisko' => 'required|min:3',
            'email' => ['required', 'email', 'max:125', Rule::unique('people')->ignore($id)],
        ], [
                'required' => 'Pole :attribute jest wymagane.',
                'email' => 'Pole :attribute musi być poprawnym adresem email.',
                'unique' => 'Podany email jest już w bazie.',
                'min' => 'Nazwa firmy musi mieć minimum :min znaków',
            ]
        );

          Person::where('id', $id)->update([
            'customer_id' => $request->customer_id,
            'imie' => $request->imie,
            'nazwisko' => $request->nazwisko,
            'position' => $request->position,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'description' => $request->description,
            'address' => $request->address,
            'email' => $request->email,
            
        ]);
           return redirect('/klienci/'.$request->customer_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person=Person::findOrFail($id);
        $person->delete();
        return back();
    }
}
