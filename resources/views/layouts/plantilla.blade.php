
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
    <script src="{{ asset('js/plantilla3.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/plantilla3.css') }}">
</head>
<div class="header">
    <a href="#" id="menu-action">
      <i class="fa fa-bars"></i>
      <span>Close</span>
    </a>
    
    <div class="logo">
      ClincCare
    </div>
    <div class="usuario">
        <ul class="nav navbar-top-links navbar-right">           
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> 
              </a>
              <ul class="dropdown-menu dropdown-user">               
                <li><a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> <i class="fa fa-fw fa-sign-out"></i>{{ __('Salir') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </li>
              </ul>        
            </li>         
        </ul> 
      
    </div>
</div>
  <div class="sidebar">
    <ul>
      <li><a href="{{route('home')}}"><i class="fa fa-desktop"></i><span>Inicio</span></a></li>      
      <li><a href="{{route('pacientes.index')}}"><i class="fa fa-ambulance"></i><span>Pacientes</span></a></li> 
      <li><a href="{{route('medicos.index')}}"><i class="fa fa-user-md"></i><span>Medicos</span></a></li>
      <li><a href="{{route('usuarios.index')}}"><i class="fa fa-users"></i><span>Usuarios</span></a></li>    
      <li><a href="{{route('config')}}"><i class="fa fa-cog"></i><span>Configuracion</span></a></li> 
    </ul>      
  </div>
  
  <!-- Content -->
  <div class="main">  
    <div id="app" class="content">
        @yield("contenido")        
    </div>
  </div>
  </div>
</body>
</html>