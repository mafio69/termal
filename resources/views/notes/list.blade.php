@extends('layouts.app')

@section('content')


    <a href="{{url('/notes/'.$customer_id).'/create'}}" title="Notatka" class="btn btn-default"><i class="fa fa-plus"
                                                                                                   aria-hidden="true"></i>
        </i> Dodaj notatkę</a><br>
    @foreach($notes as $note)
     
        @if($note->customer->id== 55)
            @if($loop->first)
                <h2>{{$note->customer->company}}</h2>
            @endif
        @else
         @if($loop->first)
            <h3>Notatki o kliencie: <a href="{{url('/klienci/'.$note->customer->id)}}" style="color:grey;" title="Pokaż">{{$note->customer->company}}</a></h3>
        @endif
        @endif
        <div class="well-sm">
            <div class=" clearfix" style="padding: .5rem;">
                <h5>{{$note->title}}</h5>
                <div class="dropdown pull-right" style="margin-bottom: 1rem;">
                    <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Menu
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

                        <li class="text-left"><a href={{ url('/notes/' . $note->id.'/edit' ) }} ><i class="fa fa-pencil"
                                                                                                    aria-hidden="true"></i>
                                Edytuj</a></li>
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

            </div>
            <div >
            <pre>
{{$note->note}}
            </pre>
            </div>
            <div class="text-right">
                Notatka z dnia: {{$note->created_at}}
            </div>
        </div>
    @endforeach



@endsection