@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dodaj zdarzenie</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{url('/zdarzenie/store')}}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('event_type_id') ? ' has-error' : '' }}">
                                <label for="event_type_id" class="col-md-4 control-label">Typ zdarzenia</label>

                                <div class="col-md-6">
                                    <select required  class="form-control" name="event_type_id" >
                                            <option value="">...</option>
                                        @foreach($events as $event)
                                            <option
                                            {{ old('event_type_id') == $event->id ? ' selected ' : '' }}
                                            value="{{$event->id}}">{{$event->type}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('event_type_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('event_type_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('person_id') ? ' has-error' : '' }}">
                                <label for="person_id" class="col-md-4 control-label">Osoba kontaktowa</label>

                                <div class="col-md-6">
                                    <select  class="form-control" name="person_id" >
                                        <option value="">...</option>
                                        @foreach($customer->person as $person)
                                            <option  {{ old('person_id') == $person->id ? ' selected ' : '' }}    value="{{$person->id}}">{{$person->imie . ' '.$person->nazwisko}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('person_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('person_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="person_id" class="col-md-4 control-label">Telefon</label>

                                <div class="col-md-6">
                                    <select  class="form-control" name="phone" >
                                        <option value="">...</option>
                                        @if($customer->phone_1)
                                            <option  {{ old('phone') == $customer->phone_1 ? ' selected' : '' }}    value="{{$customer->phone_1}}">Firmowy 1</option>
                                        @endif
                                        @if($customer->phone_2)
                                            <option  {{ old('phone') == $customer->phone_2 ? ' selected' : '' }}value="{{$customer->phone_2}}">Firmowy 2</option>
                                        @endif
                                        @if($customer->phone_3)
                                            <option {{ old('phone') == $customer->phone_3 ? ' selected' : '' }}  value="{{$customer->phone_3}}">Firmowy 3</option>
                                        @endif
                                        @foreach($customer->person as $person)
                                            @if($person->phone)
                                                <option  {{ old('phone') == $person->phone ? ' selected' : '' }} value="{{$person->phone}}">{{$person->imie }} {{$person->nazwisko}}</option>
                                            @endif
                                            @if($person->phone2)
                                                <option {{ old('phone') == $person->phone2 ? ' selected' : '' }} value="{{$person->phone2}}">{{$person->imie}} {{$person->nazwisko}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="person_id" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <select  class="form-control" name="email" >
                                        <option value="">...</option>
                                        <option {{ old('email') == $customer->email ? ' selected' : '' }} value="{{$customer->email}}">{{$customer->email}}</option>
                                        @foreach($customer->person as $person)
                                            <option {{ old('email') == $person->email ? ' selected' : '' }} value="{{$person->email}}">{{$person->imie . ' '.$person->nazwisko}}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Data wydarzenia</label>

                                <div class="col-md-6">
                                   <input placeholder="RRRR-MM-DD" value="{{ old('date') }}"  class="form-control" required type="date" name="date">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Godzina wydarzenia</label>

                                <div class="col-md-6">
                                    <input placeholder="GG:MM" value="{{ old('time') }}" class="form-control" required type="time" name="time">
                                    @if ($errors->has('time'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Tytuł</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" value="{{ old('title') }}" class="form-control" name="title" required>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Opis</label>
                                <div class="col-md-6">
                                    <input value="{{ old('description') }}"  id="title" type="text" class="form-control" name="description" required>
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