@extends('layouts.app')


@section('content')
		<h3>Notatki dotyczą {{$customer->company}}</h3>
		<form action="{{ url('/notes')}}" method="post">
		 {{ csrf_field() }}

		<input type="hidden" name="customer_id" value="{{$customer->id}}">
			<div class="form-group label-floating">
				<label for="inputtitle" class="control-label">Tytuł notatki</label>
				<input id="inputtitle" class="form-control" type="text" placeholder="Tytuł notatki" name="title">
			</div>
			<div class="form-group label-floating">
				<label for="inputnote" class="control-label">Treść notatki</label>
				<textarea class="form-control" id="inputnote"  placeholder="Treść notatki" name="note"></textarea>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Dodaj">
			</div>
		</form>



@endsection