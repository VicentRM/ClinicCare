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
<body class="fixed-nav sticky-footer bg-dark">
  
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.html">WebClinic</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">            
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{route('users.index')}}">
                        <i class="fa fa-users"></i>
                    <span class="nav-link-text">Usuarios</span>
                    </a>
                </li>  
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{route('pacientes.index')}}">
                    <i class="fa fa-users"></i>
                <span class="nav-link-text">Pacientes</span>
                </a>
            </li>      
              
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-wrench"></i>
                <span class="nav-link-text">Informes</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                <li>
                    <a href="navbar.html">Informe 1</a>
                </li>
                <li>
                    <a href="cards.html">Informe 2</a>
                </li>
                </ul>
            </li>    
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-sitemap"></i>
                <span class="nav-link-text">Configuración</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseMulti">
                <li>
                    <a href="#">Configuración clínica</a>
                </li>
                <li>
                    <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Pruebas Médicas</a>
                    <ul class="sidenav-third-level collapse" id="collapseMulti2">
                    <li>
                        <a href="#">Grupo de pruebas</a>
                    </li>
                    <li>
                        <a href="#">Editor de pruebas médicas</a>
                    </li>              
                    </ul>
                </li>
                </ul>
            </li>       
            </ul>       
            <ul class="navbar-nav ml-auto">          
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                
                            {{ Auth::user()->rolUsuario() }} 
                   
                        
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fa fa-fw fa-sign-out"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>            
        </div>
        </nav>
        <div class="content-wrapper">  
            <div id="app">
            @yield("contenido")
            </div>
        </div>
        <!-- /.content-wrapper-->
        <footer class="sticky-footer">
           
            <div class="container">
            <div class="text-center">
                <small>Copyright © WebClinic 2021</small>
            </div>
            </div>
        </footer>      
 
  </body>
</html>
