<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

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


        $niceNames = [  //nazwy dla pól formularza
            'name' => 'Nazwa',
            'email'=> 'Email adres',
        ];
        $rules = [  //zasady walidacji
            'name' => 'required|min:3',
            'email' => 'required|email|unique:customers',
        ];
        $message =[ //wiadomości wyswietlane
            'required' => 'Pole :attribute jest wymagane.',
            'email' => 'Pole :attribute musi być poprawnym adresem email.',
            'unique' => 'Podany email jest już w bazie.',
            'min' => ':attribute musi mieć minimum :min znaków',
        ];
        $this->validate($request, $rules, $message, $niceNames);

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
        $niceNames = [  //nazwy dla pól formularza
            'name' => 'Nazwa',
            'email'=> 'Email adres',
        ];
        $rules = [  //zasady walidacji
            'name' => 'required|min:3',
            'email' => 'required|email|unique:customers',
        ];
        $message =[ //wiadomości wyswietlane
            'required' => 'Pole :attribute jest wymagane.',
            'email' => 'Pole :attribute musi być poprawnym adresem email.',
            'unique' => 'Podany email jest już w bazie.',
            'min' => ':attribute musi mieć minimum :min znaków',
        ];
        $this->validate($request, $rules, $message, $niceNames);
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
        $user->not_active= true;
        $password = bcrypt(random_int(2,5000).time());
        $user->password = $password;
        $user->role = 4;
        $email = 'awd'.$user->email;
        $user->email= $email;
        $user->save();

        session()->flash('flash_message', 'Uzytkownik został zdeaktywowany!');
        return redirect()->route('users');
    }

}
