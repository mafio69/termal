@extends('layouts.app')


@section('content')

		<form action="{{ url('/klienci')}}" method="post">
		 {{ csrf_field() }}
			@if ($errors->has('company'))
				<span class="help-block">
                <strong>{{ $errors->first('company') }}</strong>
            </span>
			@endif
		<div class="form-group label-floating">
    		<label for="inputcompany" class="control-label">Firma</label>	
				<input required class="form-control {{ $errors->has('company') ? ' has-error' : '' }}" type="text" placeholder="Firma" name="company" id="inputcompany">
		</div>
		<div class="form-group label-floating">
			<label  for="inputstreet" class="control-label">Ulica</label>
			<input class="form-control"  id="inputstreet" type="text" placeholder="Ulica" name="street">
		</div>
		<div class="form-group label-floating">
			<label for="inputnr" class="control-label">Numer posesji</label>
			<input class="form-control" id="inputnr" type="text" placeholder="Numer posesji" name="nr">
		</div>
			<div class="form-group label-floating">
				<label for="inputcity" class="control-label">Miejscowość</label>
				<input class="form-control" id="inputcity" type="text" placeholder="Miejscowość" name="city">
			</div>
			<div class="form-group label-floating">
				<label for="inputzip_code" class="control-label">Kod pocztowy</label>
				<input class="form-control" id="inputzip_code" type="text" placeholder="Kod pocztowy" name="zip_code">
			</div>
			<div class="form-group label-floating">
				<label for="inputwojewodztwo" class="control-label">Wojewodztwo</label>
			<select id="inputwojewodztwo" name="province" class="form-control">
				@foreach($wojewodztwa as $wojewodztwo)
					<option {{$wojewodztwo == 'pomorskie' ? ' selected ' : ''}} value="{{$wojewodztwo}}">{{$wojewodztwo}}</option>
				@endforeach
			</select>
			</div>
			<div class="form-group label-floating">
				<label for="inputphone_1" class="control-label">Telefon</label>
				<input class="form-control" id="inputphone_1" type="text" placeholder="Telefon" name="phone_1">
			</div>
			<div class="form-group label-floating">
				<label for="inputphone_2" class="control-label">Telefon</label>
				<input class="form-control" id="nputphone_2" type="text" placeholder="Telefon" name="phone_2">
			</div>
			<div class="form-group label-floating">
				<label id="inputphone_3" for="inputphone_3" class="control-label">Telefon</label>
				<input class="form-control" type="text" placeholder="Telefon" name="phone_3">
			</div>
			<div class="form-group label-floating">
				<label for="inputnip" class="control-label">NIP</label>
				<input id="inputnip" class="form-control" type="text" placeholder="NIP" name="nip">
			</div>
			<div class="form-group label-floating">
				<label for="inputweb" class="control-label">Strona www</label>
				<input id="inputweb" class="form-control" type="text" placeholder="Strona www" name="web">
			</div>
			@if ($errors->has('email'))
				<span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
			@endif
			<div class="form-group label-floating">
				<label for="inputemail" class="control-label">Email</label>
				<input id="inputemail" class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" required type="text" placeholder="Email" name="email">
			</div>
			<div class="form-group label-floating">
				<label for="inputstatuses_id" class="control-label">Status</label>
			<select id="inputstatuses_id" class="form-control" name="statuses_id" >
				@foreach($statuses as $status)
					<option value="{{$status->id}}">{{$status->name}}</option>
				@endforeach
			</select>
			</div>
			<div class="form-group label-floating">
				<label for="inputnotes" class="control-label">Notatki</label>
				<textarea class="form-control" id="inputnotes"  placeholder="Notatki" name="notes"> </textarea>
			</div>
			<div class="form-group label-floating">
				<input type="submit" class="btn btn-success" value="Dodaj">
			</div>
		</form>



@endsection