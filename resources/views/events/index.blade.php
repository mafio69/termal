@extends('layouts.app')


@section('content')
    <h4>Lista zdarzeń</h4>
<div class="container-fluid">
    @foreach($events as $event)
        @if($loop->index % 2 == 0 ||$loop->index ==0)
            <div class="row">
        @endif
                <div class="col-sm-5" style="padding: .9rem;">
                    <h4>{{$event->customer->company}}</h4>
                    <h5>{{$event->title}} &nbsp;&nbsp;
                        <small class="pull-right">{!!  czas($event->event_data) !!}</small>
                    </h5>
                    Data zdarzenia: {{$event->event_data}} <br>
                    @if($event->person->id)
                        <a href="#" data-toggle="modal"
                           data-target="#myModal{{$loop->index}}"> {{$event->person->imie}} {{$event->person->nazwisko}}</a>
                        <br>
                    @endif
                    Email: {{$event->email}}<br>
                    Telefon:{{$event->phone}} <br>
                    <p>{{$event->description}}</p>
                    <p class="text-muted text-right">Dodał : {{$event->user->name}}</p>
                </div>
        @if(($loop->index+1) % 2 ==0 )
            @if($loop->first)

            @else
            </div>
            @endif
        @endif
        <!-- Modal ------------------------------------------------------------------------------------>
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
        <!-- END Modal ------------------------------------------- <button type="button" class="btn btn-primary">Save changes</button>-------------------------------------->
    @endforeach
</div>

@endsection