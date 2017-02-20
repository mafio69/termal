<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Customer;
use App\Project;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('customer')
                ->with('user')
                ->with('events')
                ->with('events.user')
                ->with('events.person')
                ->with('events.customer')
                ->with('events.event_type')
                ->orderBy('not_activ')
                ->orderBy('created_at')
                ->paginate(40);

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $customer = Customer::findOrFail($id);

        return  view('project.create',compact('customer'));
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
            'title'=> 'tytuł',
            'description'=> 'opis',
             ];
        $rules = [  //zasady walidacji
            'title'=> 'required|min:5',
            'description'=> 'required|min:6',
             ];
        $message =[ //wiadomości wyswietlane
            'required' => 'Pole :attribute jest wymagane.',
            'min' => 'Pole :attribute  musi mieć minimum :min znaków.',
            ];
        $this->validate($request, $rules, $message, $niceNames);
        Project::create([
            'customer_id' => $request->customer_id,
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $request->session()->flash('flash_message', 'Projekt został dodany!');

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
        $niceNames = [  //nazwy dla pól formularza
            'title'=> 'tytuł',
            'description'=> 'opis',
        ];
        $rules = [  //zasady walidacji
            'title'=> 'required|min:5',
            'description'=> 'required|min:6',
        ];
        $message =[ //wiadomości wyswietlane
            'required' => 'Pole :attribute jest wymagane.',
            'min' => 'Pole :attribute  musi mieć minimum :min znaków.',
        ];
        $this->validate($request, $rules, $message, $niceNames);
        Project::where('id',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'not_activ' => $request->not_activ,
        ]);

        $request->session()->flash('flash_message', 'Projekt został poprawiony!');

        return back();
    }
    public function off(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->not_activ = $request->not_activ;
        $project->save();
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
        //
    }
}
