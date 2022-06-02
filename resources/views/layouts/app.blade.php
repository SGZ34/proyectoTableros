<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tableros</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="/plugins/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/dist/adminlte.min.css?v=3.2.0">
    <!-- include the style -->
<link rel="stylesheet" href="/css/alertify.min.css" />
<!-- include a theme -->
<link rel="stylesheet" href="/css/themes/default.min.css" />
<link rel="stylesheet" href="/css/datatables.min.css" />
        @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa-solid fa-user"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Cerrar sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="#" class="brand-link text-center">
                
                <h2 class="brand-text font-weight-light text-center">Tableros</h2>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
                    <div class="info">
                        <h3 class="d-block text-white">{{auth()->user()->name}}</h3>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @can('/dashboard')
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <p>
                                    Dashboard
                                    <i class="fa-solid fa-border-all right"></i>
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('/roles')
                        <li class="nav-item">
                            <a href="/roles" class="nav-link">
                                <p>
                                    Roles
                                    <i class="fa-solid fa-user-gear right"></i>
                                </p>
                            </a>
                        </li>
                        @endcan
                        
                        @can('/users')
                        <li class="nav-item">
                            <a href="/users" class="nav-link">
                                <p>
                                    Usuarios
                                    <i class="fa-solid fa-users right"></i>
                                </p>
                            </a>
                        </li>
                        @endcan
                        
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                @yield('content')
            </div>

        </div>


        <aside class="control-sidebar control-sidebar-dark">

        </aside>


        <footer class="main-footer">
            <strong>Copyright &copy; {{date("Y")}}</strong>
            Todos los derechos reservados
            <div class="float-right d-none d-sm-inline-block">
                <span>Tableros</span>
            </div>
        </footer>
    </div>

    

    <script src="/plugins/jquery.min.js"></script>

    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="/js/datatables.min.js"></script>

    <script src="/dist/adminlte.js?v=3.2.0"></script>

    <script src="/plugins/Chart.min.js"></script>

    <script src="/dist/demo.js"></script>

    <script src="/dist/dashboard3.js"></script>

    <script src="/js/alertify.min.js"></script>
    
    

    @yield('scripts')
</body>

</html>