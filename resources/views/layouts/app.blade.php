<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Styles -->
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <link href="{{url('/css/footable.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('/css/font-awesome.min.css')}}" rel="stylesheet">
    <link media="print" href="{{url('/css/print.css')}}" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap-material-design.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{url('/css/ripples.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{url('/css/jquery.dropdown.css')}}">
     <link rel="shortcut icon" href="{{url('/favicon.ico')}}" type="image/x-icon">
      <link rel="icon" href="{{url('/favicon.ico')}}" type="image/x-icon"><!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
               
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                   
                    @if(auth()->check())
                    <form method="GET" action="{{ url('/search') }}" class="navbar-form navbar-left">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Szukaj klienta...">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </form>
                     <ul class="nav navbar-nav">
                        <li><a href="{{url('/home')}}">Start</a></li>
                        <li><a href="{{url('/zdarzenie/jutro')}}">Jutro</a></li>
                    </ul>

                    @endif
                    
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                     <p class="navbar-text text-right" style=" text-transform: uppercase;">{{dayWeek( Date('Y-m-d')).' '. Date('Y-m-d')}}</p>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>

                        @else
                          @include('layouts.dropdown')
                        @endif
                    </ul>

                </div>
            </div>
        </nav>
<div class="container-fluid">
    @include('layouts.flash')
    <div class="row">
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12" id="sidebar">
        @include('layouts.sidebar')
    </div>
      <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12" >
        @yield('content')
      </div>
    </div>
    </div>
</div>
    <!-- Scripts -->
    <script src="{{url('/js/app.js')}}"></script>
    <script src="{{url('/js/footable.min.js')}}"></script>
    <script src="{{url('/js/material.min.js')}}"></script> 
     <script src="{{url('/js/ripples.min.js')}}"></script> 
    
    <script>
        $(function() {
            $('table').footable();
        });


    </script>
    <script type="text/javascript">
         $('.dropdown').on('show.bs.dropdown', function() {
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  });

  // Add slideUp animation to Bootstrap dropdown when collapsing.
  $('.dropdown').on('hide.bs.dropdown', function() {
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  });
      $.material.init();  
    </script>
   
</body>
</html>
