@extends('layouts.app')

@section('content')


    <div class="panel panel-default">
        <div class="panel panel-heading clearfix">
            <h2>{{$customer->company}}
                <small>    {{$customer->city}} </small>
            </h2>
            {{$customer->status->name}}


            <div class="dropdown pull-right">
                <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Menu
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                    <li><a href="{{url('/osoba/'.$customer->id.'/create')}}" title="Dodaj osobę kontaktową."><i
                                    class="fa fa-user" aria-hidden="true"></i> Dodaj osobę kontaktową</a></li>
                    <li><a href="{{url('/zdarzenie-dodaj/'.$customer->id)}}" title="Dodaj zdarzenie"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Dodaj zdarzenie</a></li>
                    <li><a href="{{url('/notes/'.$customer->id).'/create'}}" title="Notatka"><i
                                    class="fa fa-plus" aria-hidden="true"></i>
                            Dodaj notatkę</a></li>
                    <li><a href="/klienci/{{$customer->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edytuj</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ url('/klienci/' . $customer->id ) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" onClick="return confirm('Czy na pewno chcesz usunąć?')">
                                <i class="fa fa-minus-circle" aria-hidden="true"></i> Usuń
                            </button>
                        </form>
                    </li>

                </ul>

            </div>
        </div>


        <div class="panel panel-body">
            Tel: {{$customer->phone_1}}</br>
            Tel: {{$customer->phone_2}}</br>
            Tel: {{$customer->phone_3}}</br>

            @if(!empty($customer->web))
                WWW: <a href="{{$customer->web}}" title="Strona klienta"><i class="fa fa-sitemap"
                                                                            aria-hidden="true"></i> {{$customer->web}}
                </a></br>
            @endif
            Email: <a href="mailto:{{$customer->email}}" target="_top"><i class="fa fa-envelope-o"
                                                                          aria-hidden="true"></i> {{$customer->email}}
            </a> </br>
            Adres:<br>
            <div style="margin-left: 4rem">
                ul. {{$customer->street.' '.$customer->nr}}</br>
                {{$customer->city.' '.$customer->zip_code.' '.$customer->province}}</br>
            </div>
            Notatki:
            <div style="margin-left: 4rem"> {{$customer->notes}}</div>
            </br>
            Osoba Kontaktowa:
            <ol>
                @foreach($customer->person as $person)
                    <li>
                        @if(auth()->user()->role == 'admin')
                            <form method="post" action="{{url('/osoba/'.$person->id)}}">
                                @endif
                                {{$person->imie}} {{$person->nazwisko}}
                                @if ($person->phone)
                                    Telefon: {{$person->phone}}
                                @endif
                                Email: {{$person->email}}

                                <a style="color: grey;" title="Pokaż osobę" href="{{url('/osoba/'.$person->id)}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a style="color: grey;" title="Edytuj osobę"
                                   href="{{url('/osoba/'.$person->id.'/edit')}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                @if(auth()->user()->role == 'admin')
                                    {{csrf_field()}}
                                    {{method_field('delete')}}
                                    <button style="border: none;  background-color: transparent;" title="Usuń osobę"
                                            type="submit" onClick="return confirm('Czy na pewno chcesz usunąć?')">
                                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                    </button>

                            </form>
                        @endif

                    </li>
                @endforeach
                </ol>


        </div>


    </div>
    <div class="row">
        <div class="col-sm-6 padding_0">
            <h4>Zdarzenia &nbsp; &nbsp;<a href="{{url('/zdarzenie-dodaj/'.$customer->id)}}" title="Dodaj zdarzenie"><i
                            class="fa fa-plus" aria-hidden="true"></i> </a></h4>
            @foreach($events as $event)
                <div class=" {{ $event->activ == 1 ? ' not_activ ' :'activ' }}">

                    <h4>{{$event->title}} &nbsp;&nbsp;
                        <small class="pull-right">
                            @if($event->activ != 1)
                            {!!  czas($event->event_data) !!}
                            @endif
                        </small>
                    </h4>
                    <form action="{{url('/zdarzenie/wylacz/'.$event->id)}}" method="Post">
                        {{ csrf_field() }}
                        <label class="radio-inline"><input type="radio"
                                                           {{ $event->activ == null ? 'checked' :'' }} value=""
                                                           name="activ">Aktywne</label>
                        <label class="radio-inline"><input type="radio"
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
                    Telefon:{{$event->phone}} <br>
                    <p>{{$event->description}} <a href="#" data-toggle="modal"
                                                  data-target="#edit{{$loop->index}}"><i class="fa fa-pencil"
                                                                                         aria-hidden="true"></i></a></p>
                    <p class="text-muted text-right">Dodał : {{$event->user->name}}</p>
                </div>


                <!-- Modal ------------------------------------------------------------------------------------>
                @if(is_object($event->person)) // gdy nie ma osoby kontaktowej nie ma obiektu $event->person i sie wywala to jest warunek bez którgo apka nie działa
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
          <!--  ////////////////////////////////MODAl edycji wpisu zdarzenia -->
                <div class="modal fade" id="edit{{$loop->index}}" tabindex="-1" role="dialog"
                     aria-labelledby="edit">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"
                                    id="myModalLabel">Edycja wpisu zdarzenia</h4>
                            </div>
                            <div class="modal-body clearfix">
                                <form action="{{url('/zdarzenie/edit/'.$event->id)}}" method="Post">
                                    {{ csrf_field() }}

                                    <label class="radio-inline"><input type="radio"
                                                                       {{ $event->activ == null ? 'checked' :'' }} value=""
                                                                       name="activ">Aktywne</label>
                                    <label class="radio-inline"><input type="radio"
                                                                       {{ $event->activ != null ? 'checked' :'' }} value="1"
                                                                       name="activ">Zakończone</label>
                                    <textarea type="text" name="description" class="form-control">
                                               {{$event->description }}
                                            </textarea>


                                    <hr>
                                    <div class="pull-right">
                                    <input type="submit" data-target="edit{{$loop->index}}"
                                           class="btn btn-default " value="wyslij">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- END Modal ------------------------------------------- <button type="button" class="btn btn-primary">Save changes</button>-------------------------------------->
            @endforeach
        </div>
        <div class="col-sm-6">
            <h4>Notatki &nbsp;&nbsp;<a href="{{url('/notes/'.$customer->id).'/create'}}" title="Notatka"><i
                            class="fa fa-plus" aria-hidden="true"></i>
                </a></h4>
            @if ($notes->count() > 0)
                @foreach($notes as $note)
                    <div class="well">
                        <h5><a href="{{url('notes/'.$note->id.'/edit')}}">{{$note->title}}</a></h5>
                        <p>{{$note->note}}</p>
                        <p class="text-right">{{$note->created_at}}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection