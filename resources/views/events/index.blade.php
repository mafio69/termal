@extends('layouts.app')


@section('content')
    <h4>Lista zdarzeń <span class="badge">{{$licznik}}</span></h4>
    <div class="container-fluid">
   
    <form class="form-inline" method="post" action="{{url('/zdarzenie/na-dzien')}}">
     {{ csrf_field() }}
  <div class="form-group">
    <label for="date">Data</label>
    <input type="date" class="form-control" id="date" value="{{date('Y-m-d')}}" name="date" placeholder="YYYY-MM-DD">
  </div>
  
  <button type="submit" class="btn btn-default">Wybierz dzień</button>
</form>
        {{$events}}
        @foreach($events as $event)
            @if($loop->index % 2 == 0 ||$loop->index ==0)
                <div class="row">
                    @endif
                    <div class="col-sm-6 ">
                        <div class="panel panel-default">
                            <div class="panel-body {{ $event->activ != null ? ' not_activ ' :'activ' }}">
                                <h4>
                                    <a href="{{url('/klienci/'.$event->customer->id)}}">{{$event->customer->company}}</a>
                                    &nbsp;
                                    <small>
                                        <a href="{{url('/zdarzenie/'.$event->id.'/edit')}}"> {{$event->event_type->type}}
                                            <i class="fa fa-pencil" aria-hidden="true"></i> </a></small>
                                </h4>
                                <h5>{{$event->title}}
                                    <small class="pull-right">
                                        @if($event->activ != 1)
                                            {!!  czas($event->event_data) !!}
                                        @endif
                                    </small>
                                </h5>
                                Adres : {{$event->customer->city}} ulica : {{$event->customer->street}} {{$event->customer->nr}}
                                <form action="{{url('/zdarzenie/wylacz/'.$event->id)}}" method="Post">
                                    {{ csrf_field() }}
                                    <label><input type="radio" {{ $event->activ == null ? 'checked' :'' }} value=""
                                                  name="activ">Aktywne</label>
                                    <label><input type="radio" {{ $event->activ != null ? 'checked' :'' }} value="1"
                                                  name="activ">Nie aktywny</label>
                                    <button type="submit" class="btn btn-default btn-xs">Zmień</button>
                                </form>
                                Data zdarzenia: {{$event->event_data}} <br>
                                @if(is_object($event->person) )
                                    <a href="#" data-toggle="modal"
                                       data-target="#myModal{{$loop->index}}"> {{$event->person->imie}} {{$event->person->nazwisko}}</a>
                                    <br>
                                @endif
                                Email: {{$event->email}}<br>
                                Telefon: {{$event->phone}}<br>
                                <p>{{$event->description}}  <a href="#" data-toggle="modal"
                                                              data-target="#edit{{$loop->index}}"><i
                                                class="fa fa-pencil"
                                                aria-hidden="true"></i></a></p>
                                <p class="text-muted text-right">Dodał : {{$event->user->name}}  </p>
                            </div>
                        </div>
                    </div>
                    @if(($loop->index+1) % 2 ==0 )
                        @if($loop->first)

                        @else
                            </div>
                        @endif
                    @endif
        <!-- Modal ------------------------------------------------------------------------------------>
            @if(is_object($event->person))
                <div class="modal fade" id="myModal{{$loop->index}}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>

                                <h4 class="modal-title"
                                    id="myModalLabel">{{$event->person->imie}} {{$event->person->nazwisko}}</h4>
                            </div>
                            <div class="modal-body">
                                {{$event->person->imie}}{{$event->person->nazwisko}}<br>
                                Stanowisko :{{$event->person->position}} <br>
                                Email : {{$event->person->email}}<br>
                                Telefon : {{$event->person->phone}}<br>
                                Telefon : {{$event->person->phone2}}<br>
                                Opis : {{$event->person->description}}<br>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
       
            @include('layouts.modalEdit')
    
          
        @endforeach
        {{$events}}
    </div>

@endsection