@if(auth()->check())

    <h3><a class="alert-link" style="color: #2F3133" href="{{ url('/home') }}">Termal</a></h3>
<div class="btn-group-vertical">
    @if((auth()->user()->role->type == 'admin') || (auth()->user()->role->type == 'moderator'))
        <a class="btn btn-raised" href="{{ url('/users')}}"><i class="fa fa-user-o" aria-hidden="true"></i>
            Użytkownicy</a><br>
    @endif
    <a class="btn btn-raised" href="{{ url('/klienci/create')}}"><i class="fa fa-plus" aria-hidden="true"></i>
        Dodaj klienta</a><br>

    <a class="btn btn-raised" href="{{ url('/klienci-status')}}"><i class="fa fa-eye" aria-hidden="true"></i> Klienci</a>
   
    <a class="btn btn-raised" href="{{ url('/projekt')}}"><i class="fa fa-eye" aria-hidden="true"></i> Projekty</a>
   
    <a class="btn btn-raised" href="{{ url('/zdarzenie')}}"><i class="fa fa-eye" aria-hidden="true"></i> Zdarzenia</a>
   
    <a class="btn btn-raised" href="{{ url('/osoba')}}"><i class="fa fa-eye" aria-hidden="true"></i> Osoby kontaktowe</a>
   
    <a class="btn btn-raised" href="{{ url('/notes')}}"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Notatki</a>
   
    <a href="{{url('/notes/55/list')}}" title="Zapisz nie powiązaną notatkę" class="btn btn-raised"><i
                class="fa fa-sticky-note-o" aria-hidden="true"></i> Luźne notatki</a>
    </div>
@endif