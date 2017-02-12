@extends('layouts.app')


@section('content')

		<form action="{{ url('/klienci')}}" method="post">
		 {{ csrf_field() }}
			@if ($errors->has('company'))
				<span class="help-block">
                <strong>{{ $errors->first('company') }}</strong>
            </span>
			@endif

		<input class="form-control {{ $errors->has('company') ? ' has-error' : '' }}" type="text" placeholder="Firma" name="company">
		<input class="form-control " type="text" placeholder="Ulica" name="street">
		<input class="form-control" type="text" placeholder="Nr posesji" name="nr">
		<input class="form-control" type="text" placeholder="Miejscowośc" name="city">
		<input class="form-control" type="text" placeholder="Kod pocztowy" name="zip_code">
		<input class="form-control" type="text" placeholder="Województwo" name="province" value="pomorskie">
		<input class="form-control" type="text" placeholder="Telefon" name="phone_1">
		<input class="form-control" type="text" placeholder="Telefon" name="phone_2">
		<input class="form-control" type="text" placeholder="Telefon" name="phone_3">
		<input class="form-control" type="text" placeholder="NIP" name="nip">
		<input class="form-control" type="text" placeholder="Strona www" name="web">
			@if ($errors->has('email'))
				<span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
			@endif
		<input class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" type="text" placeholder="Email" name="email">
			<select  class="form-control" name="statuses_id" >
				@foreach($statuses as $status)
					<option value="{{$status->id}}">{{$status->name}}</option>
				@endforeach
			</select>
		<textarea class="form-control"  placeholder="Notatki" name="notes"> </textarea>
		<input type="submit" class="btn btn-success" value="Dodaj">
		</form>



@endsection