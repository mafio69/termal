@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edytuj  zdarzenie</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{url('/zdarzenie/'.$event->id)}}">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="form-group{{ $errors->has('event_type_id') ? ' has-error' : '' }}">
                                <label for="event_type_id" class="col-md-4 control-label">Zakończ zdarzenie</label>

                                <div class="col-md-6">
                                    <label class="radio-inline"><input type="radio"
                                                                   {{ $event->activ == null ? 'checked' :'' }} value=""
                                                                   name="activ">Aktywne</label>
                                     <label class="radio-inline"><input type="radio"
                                                                   {{ $event->activ != null ? 'checked' :'' }} value="1"
                                                                   name="activ">Zakończ</label>
                               </div>
                            </div>
                            <div class="form-group{{ $errors->has('event_type_id') ? ' has-error' : '' }}">
                                <label for="event_type_id" class="col-md-4 control-label">Typ zdarzenia</label>

                                <div class="col-md-6">
                                    <select required  class="form-control" name="event_type_id" >
                                            <option value="">...</option>
                                        @foreach($events as $events)
                                            <option
                                                    {{ $event->event_type_id == $events->id ? ' selected ' : '' }}
                                                    value="{{$events->id}}">{{$events->type}}</option>
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
                                        @foreach($event->customer->person as $person)
                                            <option  {{ $event->person_id == $person->id ? ' selected ' : '' }}    value="{{$person->id}}">{{$person->imie . ' '.$person->nazwisko}}</option>
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
                                        @if($event->customer->phone_1 )
                                            <option  {{ $event->phone == $event->customer->phone_1 ? ' selected' : '' }}    value="{{$event->customer->phone_1}}">Firmowy 1</option>
                                        @endif
                                        @if($event->customer->phone_2 )
                                            <option  {{ $event->phone == $event->customer->phone_2 ? ' selected' : '' }}value="{{$event->customer->phone_2}}">Firmowy 2</option>
                                        @endif
                                        @if($event->customer->phone_2 )
                                            <option {{ $event->phone == $event->customer->phone_3 ? ' selected' : '' }}  value="{{$event->customer->phone_3}}">Firmowy 3</option>
                                        @endif
                                        @foreach($event->customer->person as $person)
                                            @if($person->phone)
                                                <option  {{ $event->phone == $person->phone ? ' selected' : '' }} value="{{$person->phone}}">{{$person->imie }} {{$person->nazwisko}}</option>
                                            @endif
                                            @if($person->phone2)
                                                <option $event->phone == $person->phone2 ? ' selected' : '' }} value="{{$person->phone2}}">{{$person->imie}} {{$person->nazwisko}}</option>
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
                                        <option {{ $event->email == $event->customer->email ? ' selected' : '' }} value="{{$event->customer->email}}">{{$event->customer->email}}</option>
                                        @foreach($event->customer->person as $person)
                                            <option {{ $event->email == $person->email ? ' selected' : '' }} value="{{$person->email}}">{{$person->imie . ' '.$person->nazwisko}}</option>
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
                                   <input placeholder="RRRR-MM-DD" value="{{dzien($event->event_data) }}"  class="form-control" required type="date" name="date">
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
                                    <input placeholder="GG:MM" value="{{ godzina($event->event_data) }}" class="form-control" required type="time" name="time">
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
                                    <input id="title" type="text" value="{{ $event->title }}" class="form-control" name="title" required>
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
                                    <textarea   id="description" type="text" class="form-control" name="description" required>{{ $event->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="customer_id" value="{{$event->customer->id}}">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Zapisz zmiany
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