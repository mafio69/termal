@extends('layouts.app')

@section('content')


<h3>Zadania na dziś</h3>    
      <div class="row">
    <div class="col-sm-4 padding_0">
        <h4>Projekty </h4>

        @foreach($projects as $project)

        <a href="{{url('/zdarzenie/'.$project->customer->id.'/create/'.$project->id)}}" title="Dodaj zdarzenie"><i class="fa fa-plus" aria-hidden="true"> Dodaj zdarzenie do projektu</i></a>
        <div class="well-sm {{ $project->not_activ != null ? ' not_activ ' :'activ' }}"  >
            <h5><a href="{{url('/klienci/'.$project->customer->id)}}"> {{$project->customer->company}}</a></h5>
            <h5>{{$project->title}}</h5>

            <form action="{{url('/projekt/wylacz/'.$project->id)}}" method="Post">
                {{ csrf_field() }}

                <label ><input type="radio" {{ $project->not_activ == null ? 'checked' :'' }} value="" name="not_activ">Aktywne</label>
                <label ><input type="radio"  {{ $project->not_activ != null ? 'checked' :'' }} value="1" name="not_activ">Nie aktywny</label>
                <button type="submit" class="btn btn-default btn-xs">Zmień</button>
            </form>
            <p>{{$project->description}}  <a href="#" data-toggle="modal"
                                             data-target="#editProject{{$loop->index}}"><i class="fa fa-pencil"
                                                       aria-hidden="true"></i></a></p>
            <div>

                @if(is_object($project->events))
                <ul class="list-group">
                    @foreach($project->events as $event)
                    @include('project.include.eventcollapse') 
                    @endforeach
                </ul>
                @endif
            </div>
                                                       
            <p class="text-muted text-right">Dodał : {{$project->user->name}}  </p>
        </div>
        @include('layouts.modalEditProject')
        @endforeach
    </div>
    <div class="col-sm-3 padding_0">
        <h4>Zdarzenia </a></h4>
        @foreach($events as $event)
        <div class=" {{ $event->activ == 1 ? ' not_activ ' :'activ' }}">
            <h5><a href="{{url('/klienci/'.$event->customer->id)}}">  {{$event->customer->company}}</a></h5>
            <h4>{{$event->title}} &nbsp;&nbsp;
                <small class="pull-right">
                    @if($event->activ != 1)
                    {!!  czas($event->event_data) !!}
                    @endif
                </small>
            </h4> 
            <a href="{{url('/zdarzenie/'.$event->id.'/edit')}}" > {{$event->event_type->type}} <i class="fa fa-pencil" aria-hidden="true"></i> </a>
            <form action="{{url('/zdarzenie/wylacz/'.$event->id)}}" method="Post">
                {{ csrf_field() }}
                <label ><input type="radio"
                                                   {{ $event->activ == null ? 'checked' :'' }} value=""
                    name="activ">Aktywne</label>
                <label ><input type="radio"
                                                   {{ $event->activ != null ? 'checked' :'' }} value="1"
                    name="activ">Nie aktywne</label>
                <button type="submit" class="btn btn-default btn-xs">Zmień</button>
            </form>
            Typ zdarzenia : {{$event->event_type->type}}<br>
            Data zdarzenia: {{$event->event_data}} <br>
            @if(is_object($event->person))
            <a href="#" data-toggle="modal"
               data-target="#myModal{{$loop->index}}"> {{$event->person->imie}} {{$event->person->nazwisko}}</a>
            <br>
            @endif
            Email: {{$event->email}}<br>
            Telefon: {{$event->phone}} <br>
            <p>{{$event->description}} <a href="#" data-toggle="modal"
                                          data-target="#edit{{$loop->index}}"><i class="fa fa-pencil"
                                                       aria-hidden="true"></i></a></p>
            <p class="text-muted text-right">Dodał : {{$event->user->name}}</p>
        </div>





        @if(is_object($event->person)) <!-- gdy nie ma osoby kontaktowej nie ma obiektu $event->person i sie wywala to jest warunek bez którgo apka nie działa -->
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
                        {{$event->person->imie}} {{$event->person->nazwisko}}<br>
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
    </div>

    <div class="col-sm-3">
      <h4>Notatki</h4>
        @if ($notes->count() > 0)
        @foreach($notes as $note)
        <div class="well">
            <h5><a href="{{url('notes/'.$note->id.'/edit')}}">{{$note->title}}</a></h5>
            <h4>{{$note->customer->company}}</h4>
            <p>{{$note->note}}</p>
            <p class="text-right">{{$note->created_at}}</p>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
