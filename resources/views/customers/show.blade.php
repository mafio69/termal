@extends('layouts.app')

@section('content')


    <div class="panel panel-default">
        <div class="panel panel-heading clearfix">
            <h2>{{$customer->company}}
                <small>    {{$customer->city}}</small>
            </h2>


            <div class="dropdown pull-right">
                <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Menu
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                    <li> <a href="{{url('/osoba/'.$customer->id.'/create')}}" title="Dodaj osobę kontaktową."  ><i class="fa fa-user" aria-hidden="true"></i> Dodaj osobę kontaktową</a></li>
                    <li ><a href="{{url('/notes/'.$customer->id).'/create'}}" title="Notatka"><i
                                        class="fa fa-plus" aria-hidden="true"></i>
                                Dodaj notatkę</a></li>
                    <li><a href="/klienci/{{$customer->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edytuj</a></li>
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
                WWW: <a href="{{$customer->web}}" title="Strona klienta"><i class="fa fa-sitemap" aria-hidden="true"></i> {{$customer->web}}</a></br>
            @endif
            Email: <a href="mailto:{{$customer->email}}" target="_top"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$customer->email}}</a> </br>
            Adres:<br>
               <div style="margin-left: 4rem"> 
                {{$customer->street.' '.$customer->nr}}</br>
                {{$customer->city.' '.$customer->zip_code.' '.$customer->province}}</br>
               </div>
            Notatki:<div style="margin-left: 4rem"> {{$customer->notes}}</div></br>
            Osoba Kontaktowa:
            <ol >
            @foreach($customer->person as $person)
                <li>
                    <form  method="POST" action="{{ url('/osoba/' . $person->id ) }}">
                        {{$person->imie}} {{$person->nazwisko}} 
                               @if ($person->phone)
                                Telefon: {{$person->phone}} 
                               @endif
                                Email: {{$person->email}}
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }} || 
                                <a style="color: grey;" title="Pokaż osobę" href="{{url('/osoba/'.$person->id)}}">
                                 <i class="fa fa-eye" aria-hidden="true"></i>
                                 </a>
                                <a style="color: grey;" title="Edytuj osobę" href="{{url('/osoba/'.$person->id.'/edit')}}">
                                 <i class="fa fa-pencil" aria-hidden="true"></i>
                             </a>
                             <button style="border: none; background-color: transparent;" title="Usuń osobę" type="submit" onClick="return confirm('Czy na pewno chcesz usunąć?')">
                                    <i class="fa fa-minus-circle" aria-hidden="true"></i> 
                            </button>
                            
                         </form>
                  
                      
                </li>
            @endforeach
            <ol>
            
       
        </div>
        <div class="panel panel-footer" style="background-color: transparent;">
            <br>
            <div class="pull-right">


            </div>
        </div>


    </div>
    @if ($notes->count() > 0)
        <h4>Notatki</h4>
        @foreach($notes as $note)
            <div class="well">
                <h5><a href="{{url('notes/'.$note->id.'/edit')}}">{{$note->title}}</a></h5>
                <p>{{$note->note}}</p>
                <p class="text-right">{{$note->created_at}}</p>
            </div>
        @endforeach
    @endif
@endsection