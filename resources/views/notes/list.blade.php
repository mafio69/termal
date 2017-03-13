@extends('layouts.app')

@section('content')


    <a href="{{url('/notes/'.$customer_id).'/create'}}" title="Notatka" class="btn btn-default"><i class="fa fa-plus"
                                                                                           aria-hidden="true"></i>
        </i> Dodaj notatkę</a><br>
    @foreach($notes as $note)
      @if($loop->index % 2 == 0 ||$loop->index ==0)
        <div class="row">
     @endif
      <div class="col-sm-6">
                        <div class="well">
        @if($note->customer->id== 55)
            @if($loop->first)
                <h2>{{$note->customer->company}}</h2>
            @endif
        @else
            @if($loop->first)
                <h3>Notatki o kliencie: <a href="{{url('/klienci/'.$note->customer->id)}}" style="color:grey;" title="Pokaż">{{$note->customer->company}}</a></h3>
            @endif
        @endif
   

   
                   
                            <div class="dropdown pull-right">
                                <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Menu
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                    <li><a href="{{url('/notes/'.$note->customer->id).'/create'}}" title="Notatka"><i
                                                    class="fa fa-plus" aria-hidden="true"></i> Dodaj notatkę</a></li>
                                    <li class="text-left"><a href={{ url('/notes/' . $note->id.'/edit' ) }} ><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> Edytuj</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ url('/notes/' . $note->id ) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button style="background-color: transparent;border: none;" type="submit"
                                                    onClick="return confirm('Czy na pewno chcesz usunąć?')">
                                                <i class="fa fa-minus-circle" aria-hidden="true"></i> Usuń
                                            </button>
                                        </form>
                                    </li>

                                </ul>

                            </div>
                           
                            {{$note->title}}<br>
                            <p>
                            <pre>{{$note->note}}</pre>
                            </p>
                            <p class="text-right">{{dayWeek($note->created_at)}} {{$note->created_at}}</p>
                        </div>
                    </div>
                    @if(($loop->index+1) % 2 == 0 )
                        @if($loop->first)

                        @else
                            </div>
                        @endif
                    @if($loop->last %2 != 0)
                       <div class="col-sm-6">

                       </div>
                        </div>
                        @endif
              @endif



    @endforeach



@endsection