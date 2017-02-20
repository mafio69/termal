@extends('layouts.app')


@section('content')
    <h4>Lista projektów <span class="badge">{{$projects->count()}}</span></h4>
<div class="container-fluid">
    {{$projects}}
    @foreach($projects as $project)
        @if($loop->index % 2 == 0 ||$loop->index ==0)
            <div class="row">
        @endif
                <div class="col-sm-6 well-sm {{ $project->not_activ != null ? ' not_activ ' :'activ' }}"  >
                    <a href="{{url('/zdarzenie/'.$project->customer->id.'/create/'.$project->id)}}" title="Dodaj zdarzenie"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    <h4><a href="{{url('/klienci/'.$project->customer->id)}}">
                      {{$project->customer->company}}</a></h4>
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