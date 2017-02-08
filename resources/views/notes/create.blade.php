@extends('layouts.app')


@section('content')
		<h3>Notatki dotyczą {{$customer->company}}</h3>
		<form action="{{ url('/notes')}}" method="post">
		 {{ csrf_field() }}
		<input type="hidden" name="customer_id" value="{{$customer->id}}">
		<input class="form-control" type="text" placeholder="Tytuł notatki" name="title">
		<textarea class="form-control"  placeholder="Treść notatki" name="note"></textarea>
		
		<input type="submit" class="btn btn-success" value="Dodaj">
		</form>



@endsection