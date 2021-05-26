<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--Nombre de la aplicación--}}
    <title>{{ config('app.name', 'Serviauto') }}</title>

    <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Bootstrap -->
        <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <!-- Datatables -->
        <link rel="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/datatables.min.css"/>

    <!-- Icono tab navegador-->
    <link rel="icon" href="https://serviauto.s3.eu-west-3.amazonaws.com/images_static/logo_pequeno.png">

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
        <!-- Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/datatables.min.js"></script>
        <!-- SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
        <!-- Facncybox -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

        @yield('specific_js_css_code')

       <!-- Funciones que usan Jquery -->
        <!-- Mediante JQuery comprobamos que los password coinciden -->
        <script type="text/javascript">
            function checkPasswordMatch() {
                if ($("#password").val() != $("#password-confirm").val()){
                    $("#passwordError").css("display","block");
                    $("#addButton").attr("disabled",true);
                }else{
                    $("#passwordError").css("display","none");
                    $("#addButton").removeAttr("disabled");
                }
            }
        </script>

    {{--Estilos del menú--}}
    <style>
        .menu-area{background: #30CECA}
        .dropdown-menu{padding:0;margin:0;border:0 solid transition!important;border:0 solid rgba(0,0,0,.15);border-radius:0;-webkit-box-shadow:none!important;box-shadow:none!important}
        .mainmenu a, .navbar-default .navbar-nav > li > a, .mainmenu ul li a , .navbar-expand-lg .navbar-nav .nav-link{color:#fff;font-size:16px;text-transform:capitalize;padding:16px 15px;font-family:'Arial Rounded MT Bold',sans-serif;display: block !important;}
        .mainmenu .active a,.mainmenu .active a:focus,.mainmenu .active a:hover,.mainmenu li a:hover,.mainmenu li a:focus ,.navbar-default .navbar-nav>.show>a, .navbar-default .navbar-nav>.show>a:focus, .navbar-default .navbar-nav>.show>a:hover{color: black;background: #3CB6B3;outline: 0;}
        /*==========Sub Menu=v==========*/
        .mainmenu .collapse ul > li:hover > a{background: #3CB6B3;}
        .mainmenu .collapse ul ul > li:hover > a, .navbar-default .navbar-nav .show .dropdown-menu > li > a:focus, .navbar-default .navbar-nav .show .dropdown-menu > li > a:hover{background: #3CB6B3;}
        .mainmenu .collapse ul ul ul > li:hover > a{background: #3CB6B3;}

        .mainmenu .collapse ul ul, .mainmenu .collapse ul ul.dropdown-menu{background:#30CECA;}
        .mainmenu .collapse ul ul ul, .mainmenu .collapse ul ul ul.dropdown-menu{background:#30CECA}
        .mainmenu .collapse ul ul ul ul, .mainmenu .collapse ul ul ul ul.dropdown-menu{background:#30CECA}

        /******************************Drop-down menu work on hover**********************************/
        .mainmenu{background: none;border: 0 solid;margin: 0;padding: 0;min-height:20px;width: 100%;}
        @media only screen and (min-width: 767px) {
            .mainmenu .collapse ul li:hover> ul{display:block}
            .mainmenu .collapse ul ul{position:absolute;top:100%;left:0;min-width:250px;display:none}
            /*******/
            .mainmenu .collapse ul ul li{position:relative}
            .mainmenu .collapse ul ul li:hover> ul{display:block}
            .mainmenu .collapse ul ul ul{position:absolute;top:0;left:100%;min-width:250px;display:none}
            /*******/
            .mainmenu .collapse ul ul ul li{position:relative}
            .mainmenu .collapse ul ul ul li:hover ul{display:block}
            .mainmenu .collapse ul ul ul ul{position:absolute;top:0;left:-100%;min-width:250px;display:none;z-index:1}

        }
        @media only screen and (max-width: 767px) {
            .navbar-nav .show .dropdown-menu .dropdown-menu > li > a{padding:16px 15px 16px 35px}
            .navbar-nav .show .dropdown-menu .dropdown-menu .dropdown-menu > li > a{padding:16px 15px 16px 45px}
        }

    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div id="menu_area" class="menu-area" style="background-color: white">
                    <div class="container" >
                        <div class="row">
                            <nav class="navbar navbar-light navbar-expand-lg mainmenu">
                                <a class="navbar-brand" href="{{ url('/') }}" style="background-color: white">
                                    <img  style="height: 70px" src="https://serviauto.s3.eu-west-3.amazonaws.com/images_static/logo.png">
                                </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        @auth
                                            <li class="nav-item bg-primary rounded-left" >
                                                @if( Auth::user()->role == "admin" )
                                                    <a class="nav-link {{ request()->routeIs('getVentasAdmin') ? 'active' : '' }}" href="{{ route('getVentasAdmin') }}">{{ __('Sales') }}</a>
                                                @else
                                                    <a class="nav-link {{ request()->routeIs('getVentasUser') ? 'active' : '' }}" href="{{ route('getVentasUser')}}">{{ __('Sales') }}</a>
                                                @endif
                                            </li>
                                            <li class="bg-primary">
                                                <a class="nav-link {{ request()->routeIs('showListBudget') ? 'active' : '' }}" href="{{ route('showListBudget') }}">{{ __('Budgets') }}</a>
                                            </li>


                                            <li class="dropdown bg-primary">
                                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Stock</a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li>
                                                        <a class="nav-link {{ request()->routeIs('getCars') ? 'active' : '' }}" href="{{ route('getCars') }}">{{ __('Cars') }}</a>
                                                    </li>
                                                    <li>
                                                        <a class="nav-link {{ request()->routeIs('getModels') ? 'active' : '' }}" href="{{ route('getModels') }}">{{ __('Models') }}</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="dropdown bg-primary">
                                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Customers') }}</a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li>
                                                        <a class="nav-link {{ request()->routeIs('getCustomers') ? 'active' : '' }}" href="{{ route('getCustomers') }}">{{ __('Customer Management') }}</a>
                                                    </li>
                                                    <li>
                                                        <a class="nav-link {{ request()->routeIs('showFormEmailCustomer') ? 'active' : '' }}" href="{{ route('showFormEmailCustomer') }}">{{ __('Contact') }}</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="nav-item bg-primary">
                                                <a class="nav-link {{ request()->routeIs('chat') ? 'active' : '' }}" href="{{ route('chat') }}">Chat</a>
                                            </li>
                                            <li class="na-item bg-primary">
                                                @if( Auth::user()->role == "admin" )
                                                    @if (Route::has('register'))
                                                        <li class="nav-item bg-primary">
                                                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Users') }}</a>
                                                        </li>
                                                    @endif
                                                @endif
                                            </li>
                                        @endauth
                                    </ul>

                                    <!-- Right Side Of Navbar -->
                                    <ul class="navbar-nav ml-auto">
                                        <!-- Authentication Links -->
                                        @guest
                                                <br><h2 class="pt-3 pr-3">PORTAL DE ADMINISTRACIÓN DEL CONCESIONARIO</h2>
                                        @else
                                            <li class="nav-item dropdown bg-primary border-left">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }} <span class="caret"></span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color: #30CECA" >
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        @endguest
                                        <li class="nav-item dropdown bg-primary rounded-right">
                                            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> <img  style="height: 15px"  src="https://serviauto.s3.eu-west-3.amazonaws.com/images_static/{{\App::getLocale()}}.svg">&nbsp;{{\App::getLocale()}}</span></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdown09" style="background-color: #30CECA" >
                                                <a  class="dropdown-item" href="{{ url('locale/en') }}"><img  style="height: 15px"  src="https://serviauto.s3.eu-west-3.amazonaws.com/images_static/en.svg">&nbsp;&nbsp;&nbsp;{{__('English')}}</a>
                                                <a  class="dropdown-item" href="{{ url('locale/es') }}"><img  style="height: 15px"  src="https://serviauto.s3.eu-west-3.amazonaws.com/images_static/es.svg">&nbsp;&nbsp;&nbsp;{{__('Spanish')}}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        {{-- Incluyo el posible mensaje de confirmación de eliminar o actualizar usuario--}}
        @include('sweet::alert')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
