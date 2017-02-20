@extends('layouts.app')


@section('content')
    <h2>Użytkownicy zarejstrowani w systemie <span class="badge">{{$users->count()}}</span></h2>
    <div class="clearfix"><a class="btn btn-default pull-right" href="/users/create"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj uzytkownika</a></div>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nazwa</th>
            <th>Email</th>
            <th>Rola</th>
            <th>Akcja</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr class="{{$user->not_active ? 'text-muted bg-warning ' :''}}">
            <td>{{$user->not_active ? 'Nie aktywny -- ' :''}}{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->type}}</td>
            <td>

                <div class="dropdown ">
                    <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Menu
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                       {{--}} <li><a href="{{url('/users/'.$user->id)}}" title="Pokaż"><i class="fa fa-eye" aria-hidden="true"></i> Pokaż</a></li>{{--}}
                        <li><a class="bg-warning" href="/users/{{$user->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edytuj</a></li>
                        <li>

                            <form method="POST" action="{{ url('/users/' . $user->id ) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" onClick="return confirm('Czy na pewno chcesz usunąć?')">
                                    <i class="fa fa-minus-circle" aria-hidden="true"></i> Deaktywuj
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection