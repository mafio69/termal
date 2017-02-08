<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function index(Request $request)
    {
        $users = User::with('role')->get();
        $role = Role::get();
        return view('users.index',compact('users','role'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:customers',
        ], [
                'required' => 'Pole :attribute jest wymagane.',
                'email' => 'Pole :attribute musi być poprawnym adresem email.',
                'unique' => 'Podany email jest już w bazie.',
                'min' => 'Nazwa firmy musi mieć minimum :min znaków',
            ]
        );

        User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => ['required', 'email', 'max:125', Rule::unique('users')->ignore($id)],
        ], [
                'required' => 'Pole :attribute jest wymagane.',
                'email' => 'Pole :attribute musi być poprawnym adresem email.',
                'unique' => 'Podany email jest już w bazie.',
                'min' => 'Nazwa firmy musi mieć minimum :min znaków',
            ]
        );
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);
        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::find($id);
        $user->delete();
        return redirect()->route('users');
    }

}
