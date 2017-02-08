@extends('layouts.app')

@section('content')


<div class="panel panel-default">
	<div class="panel panel-heading">
	<h2>{{$person->imie.' '.$person->nazwisko}}  <small>{{$person->customer->company}}</small></h2>
	</div>

		<div class="panel panel-body"> 
			Tel: {{$person->phone}}<br>
			Tel: {{$person->phone2}}<br>
			Stanowisko : {{$person->position}} <br>
			 
			
			Email: <a href="mailto:{{$person->email}}" target="_top">Wyślij email do: {{$person->email}}</a> </br>
			
			Adres: {{$person->address}}<br> 
			
			Opis: {{$person->description}}<br>
			
		</div>
		<div class="panel panel-footer clearfix" style="background-color: transparent;">
		<br>
			<div class="pull-right">
			<form method="POST" action="{{ url('/osoba/' . $person->id ) }}">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button class="btn btn-danger" type="submit" onClick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
				 <a class="btn btn-warning" href="{{url('/osoba/'.$person->id.'/edit')}}">Edytuj</a>
			</form>
			</div>
		</div>
</div>


@endsection