@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pulpit</div>

                <div class="panel-body">
                    <a class="btn btn-link" href="{{url('/klienci/create')}}">Dodaj klienta</a><br>
                    <a class="btn btn-link" href="{{url('notes/55/create')}}">Dodaj notatkę</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
