@extends('layouts.app')


@section('content')

	<form action="{{ url('/klienci/'.$customer->id)}}" method="post">
	 {{ csrf_field() }}
	 {{ method_field('PATCH') }}
		@if ($errors->has('company'))
			<span class="help-block">
                <strong>{{ $errors->first('company') }}</strong>
            </span>
		@endif
	<input class="form-control {{ $errors->has('company') ? ' has-error' : '' }}" type="text" value="{{$customer->company}}" placeholder="Firma" name="company">
	<input class="form-control" type="text" value="{{$customer->street}}" placeholder="Ulica" name="street">
	<input class="form-control" type="text" value="{{$customer->nr}}" placeholder="Nr posesji" name="nr">
	<input class="form-control" type="text" value="{{$customer->city}}" placeholder="Miejscowośc" name="city">
	<input class="form-control" type="text" value="{{$customer->zip_code}}" placeholder="Kod pocztowy" name="zip_code">
	<input class="form-control" type="text" value="{{$customer->province}}" placeholder="Województwo" name="province">
	<input class="form-control" type="text" value="{{$customer->phone_1}}" placeholder="Telefom" name="phone_1">
	<input class="form-control" type="text" value="{{$customer->phone_2}}" placeholder="Telefom" name="phone_2">
	<input class="form-control" type="text" value="{{$customer->phone_3}}" placeholder="Telefom" name="phone_3">
	<input class="form-control" type="text" value="{{$customer->nip}}" placeholder="NIP" name="nip">
	<input class="form-control" type="text" value="{{$customer->web}}" placeholder="Strona www" name="web">
		@if ($errors->has('email'))
			<span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
		@endif
	<input class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" type="text" value="{{$customer->email}}" placeholder="Email" name="email">
	
	<textarea class="form-control" type="text" value="{{$customer->notes}}" placeholder="Notatki" name="notes">
		{{$customer->notes}}
	</textarea>
	<input type="submit" class="btn btn-warning" value="Popraw">
	</form>



@endsection