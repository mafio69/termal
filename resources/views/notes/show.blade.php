@extends('layouts.app')

@section('content')


<div class="panel panel-default">
	<div class="panel panel-heading">
	<h2>{{$customer->company}}<small>	{{$customer->city}}</small></h2>
	</div>

		<div class="panel panel-body"> 
			Tel: {{$customer->phone_1}}</br>
			Tel: {{$customer->phone_2}}</br>
			Tel: {{$customer->phone_3}}</br>
			 
			@if(!empty($customer->web))
			WWW: <a href="{{$customer->web}}" title="Strona klienta">Wejdź na stronę: {{$customer->web}}</a></br>
			@endif
			Email: <a href="mailto:{{$customer->email}}" target="_top">Wyślij email do: {{$customer->email}}</a> </br>
			
			Adres: {{$customer->city.' '.$customer->street.' '.$customer->nr}}</br> 
			Adres II: {{$customer->zip_code.' '.$customer->province}}</br>
			Osoba Kontaktowa: {{$customer->person}}</br>
			Notatki: {{$customer->notes}}</br>
		</div>
		<div class="panel panel-footer clearfix" style="background-color: transparent;">
		<br>
			<div class="pull-right">
			<form method="POST" action="{{ url('/klienci/' . $customer->id ) }}">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button class="btn btn-danger" type="submit" onClick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
			    <a class="btn btn-warning" href="{{url('/klienci/'.$customer->id.'/edit')}}">Edytuj</a>
			</form>
			</div>
		</div>
</div>


@endsection