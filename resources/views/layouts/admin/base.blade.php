<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        @yield('title')
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        @yield('description')
        <meta name="msapplication-tap-highlight" content="no">
        <script src="https://kit.fontawesome.com/e948f2dbbf.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo/R.png') }}">
        <link rel="stylesheet" href="{{ asset('css/admin/base.css') }}">
        <link rel="stylesheet" href="{{ asset('/icons/pe-icon-7-stroke.css') }}">
    
        @yield('css')
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    <a href="/"><div class="logo-src"><img src="{{ asset('img/logo/recluter.png') }}" style="height: 26px" alt="Recluter"></div></a>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa-solid fa-magnifying-glass fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="app-header__content">
                    <div class="app-header-right">
                        <div class="search-wrapper">
                            <div class="input-holder">
                                <input type="text" class="search-input" placeholder="Escribe para buscar..">
                                <button class="search-icon">
                                    <span></span>
                                </button>
                            </div>
                            <button class="close"></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- SIDEBAR -->
            <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i><i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                            </button>
                        </span>
                    </div>
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Entidades</li>
                                @can('admin.usuarios.index')
                                    <li>
                                        <a href="#">
                                            <i class="metismenu-icon fa-solid fa-users"></i>
                                            Usuarios
                                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="/usuarios/create">
                                                    <i class="metismenu-icon"></i>
                                                    Crear
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/usuarios">
                                                    <i class="metismenu-icon"></i>
                                                    Listar
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon fa-regular fa-building"></i>
                                        @if(Auth::user()->roles->pluck('name')->contains('Admin'))
                                            Empresas
                                        @else
                                            Empresa
                                        @endif
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                @can('admin.empresas.create')
                                            <li>
                                                <a href="/empresas/create">
                                                    <i class="metismenu-icon"></i>
                                                    Crear
                                                </a>
                                            </li>
                                            
                                @endcan
                                        <li>
                                            <a href="/empresas">
                                                <i class="metismenu-icon"></i>
                                                @if(Auth::user()->roles->pluck('name')->contains('Admin'))
                                                    Listar
                                                @else
                                                    Editar
                                                @endif
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Reclutamiento</li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon fa-solid fa-clipboard-list"></i>
                                        Entrevistas
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        @can('admin.entrevistas.create')
                                            <li>
                                                <a href="#">
                                                    <i class="metismenu-icon"></i>
                                                    Crear
                                                </a>
                                            </li>
                                        @endcan
                                        <li>
                                            <a href="#">
                                                <i class="metismenu-icon"></i>
                                                Listar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="metismenu-icon"></i>
                                                Ver candidaturas
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon fa-solid fa-id-card"></i>
                                        Candidatos
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="metismenu-icon"></i>
                                                Listar
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Perfil</li>
                                <li>
                                    <a href="/">
                                        <i class="metismenu-icon fa-solid fa-right-from-bracket"></i>Cerrar sesión
                                    </a>                
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div>
                                        @yield('content-title')
                                        <div class="page-title-subheading">@yield('content-subtitle')</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="loading show">
            <div class="spin"></div>
        </div>
        <div class="app-drawer-overlay d-none animated fadeIn"></div>
        <!-- PLUGINS -->
        <script type="text/javascript" src="{{ asset('js/admin/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/admin/metisMenu.js') }}"></script>
        @yield('js')
        <!-- JS -->
        <script type="text/javascript" src="{{ asset('js/admin/demo.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/admin/app.js') }}"></script>

    </body>
</html>
