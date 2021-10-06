<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="Sistema Interno">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/imagenes/LogoIcono_0.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/imagenes/LogoIcono_0.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cersa Sistema</title>


     <!-- Iconos-->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">      
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> 
     <!--fin iconos-->

   <!-- CSS COMPILADO CON LARAVEL MIX-->
    <link rel="stylesheet" type="text/css" href="css/plantilla.css">

</head>

<body>
<!--Abrimos id app que -->
<div id="app">


<!-- page-wrapper Start-->
<div class="page-wrapper">

    <!-- cabecera-->
    <div class="page-main-header">
        <div class="main-header-right row">

            <div class="main-header-left d-lg-none">
                <div class="logo-wrapper">
                    <a href="#">
                        <img class="blur-up lazyloaded" src="assets/imagenes/LogoIcono_0.png" alt="">
                     </a>
                </div>
            </div>
            <!--toggle ocultar-->
            <div class="mobile-sidebar">
                <div class="media-body text-right switch-sm">
                    <label class="switch">
                        <a href="#">
                            <i id="sidebar-toggle" data-feather="align-left"></i>                     
                        </a>
                    </label>
                </div>
            </div>
            <!--fin togle ocultar-->

            <!--navegacion de cabera-->
            <div class="nav-right col">   
              
                         
            </div>
            <div class="nav-right col">
                <ul class="nav-menus">
                 
                    <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize-2"><polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline><line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg></a></li>
               
              
                    <li><h6>{{Auth::user()->usuario}}</h6></li>
                     <li class="onhover-dropdown">
                  
                        <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="assets/imagenes/user.png" alt="header-user">
                          
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">

                              <li>
                                 <a href="{{ route('cerrarsesion') }}"   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-in-alt"></i> &nbsp; Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('cerrarsesion') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                          
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></div>
            </div>            <!--fin de navegacion de cabecera-->
        </div>
    </div>
    <!--fin de cabecera -->
  @if(Auth::check()) <!--si el usuario esta autentificado-->
        @if (Auth::user()->idrol == 1)
             @include('plantilla.menuadministrador')    
        @elseif (Auth::user()->idrol == 2)
             @include('plantilla.menucounter')
        @elseif (Auth::user()->idrol == 3)
             @include('plantilla.menuoperaciones')
        @else
  
        @endif

    @endif
  
    <!--Contenido-->
    <div class="page-body">     
        @yield('contenido')               
    </div>
    <!--Fin contenido-->

    <!--Footer-->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 footer-copyright">
                    <p class="mb-0">Copyright 2021 © CampiñaTours - Todos los derechos Reservados</p>
                </div>
                <div class="col-md-6">
                    <p class="pull-right mb-0">Ronal Sanchez Irigoin<i class="fa fa-heart"></i></p>
                </div>
            </div>
        </div>
    </footer>
    <!--Fin footer-->

    </div>         
</div>
</div>


<!-- JS COMPILADO CON LARAVEL MIX-->



<script src="js/app.js"></script>
<script src="js/plantilla.js"></script>




</body>
</html>
