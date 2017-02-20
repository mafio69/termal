@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dodaj Projekt do firmy : {{$customer->company}}</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{url('/projekt/store')}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Tytuł</label>
                                <div class="col-md-6">
                                    <input placeholder="Tu wpisz tytuł" id="title" type="text" value="{{ old('title') }}" class="form-control" name="title" required>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Opis</label>
                                <div class="col-md-6">
                                    <textarea placeholder="Tu wpisz opis projektu" value="{{ old('description') }}"  id="description" type="text" class="form-control" name="description" required></textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="customer_id" value="{{$customer->id}}">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Dodaj
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection