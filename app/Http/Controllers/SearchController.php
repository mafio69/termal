<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\customer;
use App\Note;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function customers()
    {
        $search_phrase = Input::get('q');
        $search_results = Customer::where('email', 'like', '%' . $search_phrase . '%')
            ->orWhere('company', 'LIKE', '%' . $search_phrase . '%')
            ->orWhere('city', 'LIKE', '%' . $search_phrase . '%')
            ->orWhere('nip', 'LIKE', '%' . $search_phrase . '%')
            ->orWhere('phone_1', 'LIKE', '%' . $search_phrase . '%')
            ->orWhere('phone_2', 'LIKE', '%' . $search_phrase . '%')
            ->orWhere('phone_3', 'LIKE', '%' . $search_phrase . '%')

            ->paginate(10);
        $notes = Note::all();
        return view('customers.search', compact('search_results', 'search_phrase', 'notes'));
    }
}
