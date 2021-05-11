<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">
</head>
  <body>
    <div class="grid-container">
  
      <div class="menu-left  bg-dark" >    
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
       </button>
    
        <nav class="navbar navbar-default" role="navigation" id="navbarResponsive">
        <!-- Brand and toggle get grouped for better mobile display -->  
        <!-- Main Menu -->
        <div class="side-menu-container">
          <ul class="nav navbar-nav">  
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#"><i class="fa fa-puzzle-piece"></i> Components</a></li>
            <li><a href="#"><i class="fa fa-heart"></i> Extras</a></li>              
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </nav>  
    </div>
      <div class="menu-top">  
     </div>
      <div class="contenido">@yield("contenido")</div>
    </div>
  </body>
</html>