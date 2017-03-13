@extends('layouts.app')


@section('content')
   
    <div class="container-fluid">
       
     
          
                <div class="row">
                  
                    <div class="col-sm-8 col-sm-offset-2" >
                        <div class=" panel panel-default" style="max-height: 100%;padding: .5rem;">
                            <div class="panel-body {{ $project->not_activ != null ? ' not_activ ' :'activ' }}">

                                <a href="{{url('/zdarzenie/'.$project->customer->id.'/create/'.$project->id)}}"
                                   title="Dodaj zdarzenie"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                <h5><a href="{{url('/klienci/'.$project->customer->id)}}">
                                        {{$project->customer->company}}</a></h5>
                                <h4> {{$project->title}}</h4>
                                <p>{{$project->description}} <a href="#" data-toggle="modal"
                                                                data-target="#editProject{{$project->id}}"><i
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
                                                @include('layouts.modalEdit')
                                            @endforeach
                                        </ol>
                                    @endif
                                </div>
                                <p class="text-muted text-right">Dodał : {{$project->user->name}}  </p>
                            </div>
                        </div>
                    </div>
           </div>
     
     
    </div>
 @include('layouts.modalEditProject')
@endsection