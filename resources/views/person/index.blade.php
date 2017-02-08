@extends('layouts.app')

@section('content')
<div class="table-responsive">
<h4>Lista osób kontaktowych <span class="badge">{{$count}}</span> </h4>
{{ $people->links() }}
<table class="table">
	<tr><th>Imie</th><th>Nazwisko</th><th>Firma</th><th>Stanowisko</th><th>Telefon</th><th>Email</th><th>Akcja</th></tr>
	@foreach($people as $person)
        <tr>
            <td>{{$person->imie}}</td> 
            <td>{{$person->nazwisko}}</td>
            <td>{{$person->customer->company}}</td>
            <td>{{$person->position}}</td>
            <td>{{$person->telefon}}</td>
            <td>{{$person->email}}</td>
            <td>
            <div class="dropdown ">
  				<button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    				Menu<span class="caret"></span>
  				</button>
				  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <li><a href="{{url('/osoba/'.$person->id)}}" title="Pokaż"><i class="fa fa-eye" aria-hidden="true"></i> Pokaż</a></li>				
                                        <li><a  href="{{url('/osoba/'.$person->id.'/edit')}}"><i class="fa fa-pencil" aria-hidden="true"></i>Edytuj</a></li>
					<li>
                                            <form method="POST" action="{{ url('/osoba/' . $person->id ) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button  type="submit" onClick="return confirm('Czy na pewno chcesz usunąć?')"><i class="fa fa-minus-circle" aria-hidden="true"></i> Usuń</button>
				 
                                            </form>
                                        </li>
                                  </ul>
			</div>
            
            </td>
        </tr>
	@endforeach

</table>
</div>
{{ $people->links() }}
@endsection