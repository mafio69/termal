@extends('layouts.app')


@section('content')
    <h4>Lista projektów <span class="badge">{{$projects->count()}}</span></h4>
    <div class="container-fluid">
        {{$projects}}
        @foreach($projects as $project)
            @if($loop->index % 2 == 0 ||$loop->index ==0)
                <div class="row">
                    @endif
                    <div class="col-sm-6">
                        <div class=" panel panel-default" style="max-height: 100%;padding: .5rem;">
                            <div class="panel-body {{ $project->not_activ != null ? ' not_activ ' :'activ' }}">

                                <a href="{{url('/zdarzenie/'.$project->customer->id.'/create/'.$project->id)}}"
                                   title="Dodaj zdarzenie"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj zdarzenie do projektu</a>
                                <h5><a href="{{url('/klienci/'.$project->customer->id)}}">
                                        {{$project->customer->company}}</a></h5>
                                <h4><a href="{{url('/projekt/'.$project->id)}}" title="Pokaż projekt">{{$project->title}}</a></h4>

                               
                                <p>{{$project->description}} <a href="#" data-toggle="modal"
                                                                data-target="#editProject{{$loop->index}}"><i
                                                class="fa fa-pencil"
                                                aria-hidden="true"></i></a></p>
                                <form action="{{url('/projekt/wylacz/'.$project->id)}}" method="Post">
                                    {{ csrf_field() }}

                                    <label><input type="radio"
                                                  {{ $project->not_activ == null ? 'checked' :'' }} value=""
                                                  name="not_activ">Aktywne</label>
                                    <label><input type="radio"
                                                  {{ $project->not_activ != null ? 'checked' :'' }} value="1"
                                                  name="not_activ">Nie aktywny</label>
                                    <button type="submit" class="btn btn-default btn-xs">Zmień</button>
                                </form>
                                <div>
                                    <h4>Zdarzenia</h4>
                                    @if(is_object($project->events))
                                        <ol>
                                            @foreach($project->events as $event)
                                                @include('project.include.eventcollapse')
                                            @endforeach
                                        </ol>
                                    @endif
                                </div>
                                <p class="text-muted text-right">Dodał : {{$project->user->name}}  </p>
                            </div>
                        </div>
                    </div>
                    @if(($loop->index+1) % 2 ==0 )
                        @if($loop->first)

                        @else
                </div>
            @endif
            @endif
            @include('layouts.modalEditProject')
        @endforeach
        {{$projects}}
    </div>

@endsection