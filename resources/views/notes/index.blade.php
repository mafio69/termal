@extends('layouts.app')

@section('content')

        <h4>Pozycji w zestawieniu {{$notes->count()}}</h4>
        {{ $notes->links() }}

        @foreach($notes as $note)
        @if($note->customer->id !== 55)
            <div class="well">
                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Menu
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                    <li><a href="{{url('/notes/'.$note->customer->id).'/create'}}" title="Notatka" ><i class="fa fa-plus" aria-hidden="true"></i> Dodaj notatkę</a></li>
                        <li class="text-left"><a href={{ url('/notes/' . $note->id.'/edit' ) }} ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edytuj</a></li>
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
                <h4><a href="{{url('/klienci/'.$note->customer->id)}}" style="color:grey;" title="Pokaż">{{$note->customer->company}}</a>
                    <small> {{$note->customer->city}}</small>
                </h4>
                {{$note->title}}<br>
                <p><pre>{{$note->note}}</pre></p>
                <p class="text-right">{{$note->created_at}}</p>
            </div>
            @endif





    @endforeach


    {{ $notes->links() }}
@endsection