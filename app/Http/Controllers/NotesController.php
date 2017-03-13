<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Note;

class NotesController extends Controller
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
        if(auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'moderator' ){
        $notes = Note::where('customer_id','<>',55)
                ->orderBy('created_at','desc')
                ->with('customer')
                ->paginate(40);   
        }else{
        $notes = Note::where('customer_id','<>',55)
                ->where('user_id',auth()->id())
                ->orderBy('created_at','desc')
                ->with('customer')
                ->paginate(40);
        }
        return view('notes.index',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($customer_id)
    {
        
        $customer = Customer::findOrFail($customer_id);
       
        return view('notes.create',compact('customer'));
    }


    public function roster($customer_id)
    {
        if(auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'moderator' ){
         $notes = Note::where('customer_id',$customer_id)
                 ->with('customer')
                 ->orderBy('created_at','desc')
                 ->get();}
        else{
        $notes = Note::where('customer_id',$customer_id)
                ->where('user_id',auth()->id())
                ->with('customer')
                ->orderBy('created_at','desc')
                ->get();
        }
        return view('notes.list',compact('notes','customer_id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Note;
        $note->customer_id = $request->customer_id;
        $note->user_id = auth()->id();
        $note->title = $request->title;
        $note->note = $request->note;
        $note->save();
        if($request->customer_id == 55){
            $customer_id = $request->customer_id;
            $notes = Note::where('customer_id',$request->customer_id)
                    ->with('customer')
                    ->orderBy('created_at','desc')
                    ->get();
            return view('notes.list',compact('notes','customer_id'));
        }
        if($request->customer_id != 55)
        return redirect('/klienci/'.$request->customer_id);
        else
        return redirect('/notes/'.$request->customer_id.'/list');   
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
        $note = Note::findOrFail($id);
        return view('notes.edit',compact('note'));
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

        $note = Note::findOrFail($id);
        $note->title = $request->title;
        $note->note = $request->note;
        $note->save();
        if($request->customer_id != 55)
        return redirect('/klienci/'.$request->customer_id);
        else
        return redirect('/notes/'.$request->customer_id.'/list');   
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note=Note::findOrFail($id);
        $note->delete();
        return back();
    }
}
