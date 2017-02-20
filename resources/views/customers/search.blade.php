@extends('layouts.app')

@section('content')

    @if($customers->count()>0)
        <h3>Wyniki wyszukiwania frazy :{{$search_phrase}} <span class="badge">{{$customers->count()}}</span></h3>
        {{ $customers->appends(['q' => $search_phrase])->links() }}
        @include('customers.include.table')
        {{ $customers->appends(['q' => $search_phrase])->links() }}
    @else
        <h3>Brak wyników wyszukiwania</h3>
    @endif
@endsection