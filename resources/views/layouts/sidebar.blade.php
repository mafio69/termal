@if(auth()->check())

 <h3><a class="alert-link" style="color: #2F3133" href="{{ url('/home') }}" >Termal</a></h3>

 @if((auth()->user()->role->type == 'admin') || (auth()->user()->role->type == 'moderator'))
   <a class="btn btn-link" href="{{ url('/users')}}"><i class="fa fa-eye" aria-hidden="true"></i> Użytkownicy</a><br>
 @endif
<a class="btn btn-link" href="{{ url('/klienci/create')}}"><i class="fa fa-plus" aria-hidden="true"></i>
 Dodaj klienta</a><br>
 <br>
<a class="btn btn-link" href="{{ url('/osoba')}}"><i class="fa fa-eye" aria-hidden="true"></i> Wyswietl osoby kontaktowe</a><br>
<a class="btn btn-link" href="{{ url('/klienci')}}"><i class="fa fa-eye" aria-hidden="true"></i> Wyswietl klientów</a><br>
<a class="btn btn-link" href="{{ url('/notes')}}"><i class="fa fa-eye" aria-hidden="true"></i> Wyświetl notatki</a><br>
<a href="{{url('/notes/55/list')}}" title="Pokaż" class="btn btn-link"><i class="fa fa-eye" aria-hidden="true"></i> Luźne notatki</a>
@endif