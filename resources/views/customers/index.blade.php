@extends('layouts.app')

@section('content')
	<h4>Lista klientów <span class="badge">{{$count}}</span> </h4>
	{{ $customers->links() }}
        <div class="dropdown " style="margin-bottom: .5rem;">
         <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Filtruj<span class="caret"></span></button>
         <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
             <li> <a href="{{url('/klienci-status')}}">Bez filtra</a></li>
             @foreach($statuses as $status)
             <li> <a href="{{url('/klienci-status/'.$status->id)}}">{{$status->name}}</a></li>
             @endforeach
         </ul>  
        </div>
	@include('customers.include.table')

{{ $customers->links() }}
@endsection