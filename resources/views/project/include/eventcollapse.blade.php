
    <li class="list-group-item"><button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$event->id}}">{{$event->title}} </button>{{$event->created_at}}</li>
      <div id="collapse{{$event->id}}" class="panel-collapse collapse">
        <div class="panel-body">
              <div class=" {{ $event->activ == 1 ? ' not_activ ' :'activ' }}">
                        <small class="pull-right">
                            @if($event->activ != 1)
                            {!!  czas($event->event_data) !!}
                            @endif
                        </small>
                   
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
                    Osoba prowadząca: {{$event->person->imie}} {{$event->person->nazwisko}}</a>
                        <br>
                    @endif
                    Email: {{$event->email}}<br>
                    Telefon: {{$event->phone}} <br>
                    <p>{{$event->description}} <a href="#" data-toggle="modal"
                                                  data-target="#edit{{$loop->index}}"><i class="fa fa-pencil"
                                                                                         aria-hidden="true"></i></a></p>
                   </div>

        </div>
        <div class="panel-footer text-left">Dodał : {{$event->user->name}}</div>
      </div>
     