@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dodaj osobę kontaktową do firmy: {{$customer->company}} <small>{{$customer->city}}</small></div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="post" action="{{url('/osoba/store')}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Imie</label>

                                <div class="col-md-6">
                                    <input id="imie" type="text" class="form-control" name="imie" value="{{ old('imie') }}" required autofocus>

                                    @if ($errors->has('imie'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('imie') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nazwisko</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="nazwisko" value="{{ old('nazwisko') }}" required>

                                    @if ($errors->has('nazwisko'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nazwisko') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                                <label for="position" class="col-md-4 control-label">Stanowisko</label>

                                <div class="col-md-6">
                                    <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" required>

                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Adres</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Telefon</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="phone" value="{{ old('phone') }}" >

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone2') ? ' has-error' : '' }}">
                                <label for="phone2" class="col-md-4 control-label">Telefon II</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="phone2" value="{{ old('phone2') }}" >

                                    @if ($errors->has('phone2'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone2') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Adres</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="address" value="{{ $customer->city }}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Opis</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="description" value="{{ old('description') }}">

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="customer_id" value="{{$customer->id}}">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Dodaj
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection