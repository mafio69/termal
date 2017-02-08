@extends('layouts.app')


@section('content')
    <h4>Edytujesz naotakę dotyczącą klienta {{$note->customer->company}}</h4>
    <p>Z dnia: {{$note->created_at}}</p>
    <form action="{{ url('/notes/'.$note->id)}}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input type="hidden" name="customer_id" value="{{$note->customer->id}}">
        <input type="text" class="form-control" placeholder="Tytuł" name="title" value="{{$note->title}}">
        <textarea type="text" class="form-control"  placeholder="Notatki" name="note">{{$note->note}}</textarea>
        <input type="submit" class="btn btn-warning" value="Popraw">
    </form>



@endsection