@extends('layouts.app')


@section('content')
<h4>Wydarzenia na dzień: {{dayWeek( $data)}} {{$data}} </h4>
<div class="table-responsive table-striped table-hover" style="overflow: visible;">
    <table class="table footable table-striped table-hover" >
   <thead>
	    <tr data-expanded="true">
	    	<th style="max-width: 5rem;">Nazwa</th><th  data-breakpoints="xs">Adres</th><th data-breakpoints="xs sm">Telefony</th><th data-breakpoints="xs sm md">Kontakt</th><th data-breakpoints="xs sm md">Opis</th>
	    </tr>
	</thead>
	<tbody>
		 @foreach($events as $event)
		 <tr>
			 <td> <a href="{{url('/klienci/'.$event->customer->id)}}" class="link-grey" title="Pokaż">{{$event->customer->company}}</a></td>
			 <td><span style="white-space: nowrap;">{{$event->customer->city}}</span> {{$event->customer->zip_code}} <br>{{$event->customer->street}} {{$event->customer->nr}} </td>
		 	<td><span style="white-space: nowrap;">tel: {{$event->customer->phone_1}}</span><br>tel: {{$event->customer->phone_2}} <br>tel: {{$event->customer->phone_3}}</td>
			<td> @if(is_object($event->person) )
					 {{$event->person->imie}} {{$event->person->nazwisko}}<br>
					<span style="white-space: nowrap;"> {{$event->person->phone}}</span> <br>
					 {{$event->person->phone_2}}
					<br>
				@endif</td>
			<td>{{$event->title}}<br>{{$event->description}}</td>
		 </tr>
		 @endforeach
	</tbody>
</table>
</div>
@endsection