@extends('layouts.app')

@section('content')

@if($search_results->count()>0)
	<h3>Wyniki wyszukiwania frazy :{{$search_phrase}} {{$search_results->count()}}</h3>
	<div class="table-responsive">
	{{ $search_results->appends(['q' => $search_phrase])->links() }}
	<table class="table">
		<tr><th>Firma</th><th>Miasto</th><th>Telefon</th><th>Email</th><th>WWW</th>Akcja</tr>
	@foreach($search_results as $customer)

		<tr>
			<td>
			<a href="{{url('/klienci/'.$customer->id)}}" style="color:grey;" title="Pokaż">{{$customer->company}}</a>
			</td>
			<td>
			{{$customer->city}}
			</td>
			<td>
			{{$customer->phone_1}}
			</td>
			<td>
			{{$customer->email}}
			</td>
			<td>
			@if(!empty($customer->web))
			<a href="http://{{$customer->web}}" title="Wejdż na strone klienta" target="_blank">Strona klienta</a>
			@endif
			</td>
			<td>
			<div class="dropdown ">
  				<button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    				Menu
   		 				<span class="caret"></span>
  				</button>
				  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
				    <li><a href="{{url('/klienci/'.$customer->id)}}" title="Pokaż" class="btn btn-link btn-sm">Pokaż</a></li>
				    @foreach($notes as $note)
				    @if($customer->id == $note->customer_id)
				    <li><a href="{{url('/notes/'.$customer->id.'/list')}}" title="Pokaż" class="btn btn-link btn-sm">Pokaż notatki</a></li>
				 	@endif
				 	@endforeach
				    <li><a href="{{url('/notes/'.$customer->id).'/create'}}" title="Notatka" class="btn btn-link btn-sm">Dodaj notatkę</a></li>				  
				  </ul>
			</div>
			</td>
		</tr>


	</div>
	@endforeach
		</table>
			{{ $search_results->appends(['q' => $search_phrase])->links() }}
@else
	<h3>Brak wyników wyszukiwania</h3>
@endif
@endsection