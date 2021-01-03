<!doctype html>
@if(!(App\User::admin()))
    <?php header("Location: /login/"); ?>
@endif
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Truck Easy Moving - PROS') }}</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/resources/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/resources/vendor/font-awesome/css/font-awesome.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="/resources/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/resources/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/resources/css/custom.css">
    <link rel="stylesheet" href="/resources/css/magnific-popup.min.css" />
    <!-- Favicon-->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <!--link href='/resource/vendor/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='/resource/vendor/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />

    <script src='/resource/vendor/fullcalendar/packages/core/main.js'></script>
    <script src='/resource/vendor/fullcalendar/packages/daygrid/main.js'></script-->
    
</head>
<body> 

    <!-- TOPO DA PÁGINA & MENU LATERAL ESQUERDO -->    
    <header class="header">   
        
        <!-- Navbar-->
        <nav class="navbar navbar-expand-lg">


            <div class="container-fluid d-flex align-items-center justify-content-between">
        
                <!-- Navbar topo esquerdo Truck easy ADMIN-->
                <div class="navbar-header">
                    <!-- Navbar Header-->
                    <a href="javascript:;" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary"><i class="fa fa-shield" aria-hidden="true"></i> Pro</strong><strong>Hero</strong></div>
                    <div class="brand-text brand-sm"><strong class="text-primary"><i class="fa fa-shield" aria-hidden="true"></i></strong></div></a>
                    <!-- Sidebar Toggle Btn-->
                    <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
                </div>
                <!-- / Navbar topo esquerdo Truck easy ADMIN-->


                <!-- Navbar topo DIRETO (links de acesso rápido)-->
                <div class="right-menu list-inline no-margin-bottom"> 

                    <!-- Log out -->
                    <div class="list-inline-item logout">
                        
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><span class="d-none d-sm-inline">Login </span><i class="icon-logout"></i></a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><span class="d-none d-sm-inline">Register </span><i class="icon-logout"></i></a>
                                </li>
                            @endif
                        @else
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                               <span class="d-none d-sm-inline">Logout </span><i class="fa fa-power-off" aria-hidden="true"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                                
                        @endguest
                        
                    </div>
                    <!-- /Log out -->
                </div>
                <!-- /Navbar topo DIRETO (links de acesso rápido)-->


            </div>
      </nav>
    </header>
    <!--/ TOPO DA PÁGINA & MENU LATERAL ESQUERDO -->  

    <div class="d-flex align-items-stretch">
      
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
        
            <!-- Avatar Header -->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar">
                    
                    @if (auth()->user()->image)
                        <img src="/storage/app/public/{{ auth()->user()->image }}" class="img-fluid rounded-circle">
                    @else
                        <img src="/resources/img/no-avatar.png" alt="..." class="img-fluid rounded-circle">
                    @endif
                    
                </div>
                <div class="title">
                    <h1 class="h5">{{ Auth::user()->firstName }}</h1>
                    <p>{{ Auth::user()->profile }}</p>
                </div>
            </div>
            @if (App\User::admin())
            
            <span class="heading">Main</span>
            <!-- Avatar Header-->

            <!-- MAIN NAVBAR -->
            <ul class="list-unstyled">
                <li class="{{ Str::endsWith(Request::url(), '/admin') ? 'active' : "" }}"><a href="{{ url('/admin') }}"> <i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>
                
                <li class="{{ Str::contains(Request::url(), 'order') ? 'active' : "" }}"><a href="{{ url('admin/orders/') }}"> <i class="fa fa-ticket" aria-hidden="true"></i>Orders</a></li>
                <li class="{{ Str::contains(Request::url(), 'customers') ? 'active' : "" }}"><a href="{{ url('admin/customers/') }}"><i class="fa fa-users" aria-hidden="true"></i>Customers</a></li> 
                <li class="{{ Str::contains(Request::url(), 'resources') ? 'active' : "" }}"><a href="{{ url('admin/resources/') }}"> <i class="fa fa-address-card-o" aria-hidden="true"></i>Resources</a></li>
                <li class="{{ Str::contains(Request::url(), 'replacement') ? 'active' : "" }}"><a href="{{ url('admin/replacements') }}"> <i class="fa fa-exchange" aria-hidden="true"></i>Replacements</a></li>
                <li class="{{ Str::contains(Request::url(), 'expenses') ? 'active' : "" }}"><a href="{{ url('admin/expenses/') }}"> <i class="fa fa-money" aria-hidden="true"></i>Expenses</a></li>
                <li class="{{ Str::contains(Request::url(), 'services') ? 'active' : "" }}"><a href="{{ url('admin/services/') }}"> <i class="fa fa-shopping-cart" aria-hidden="true"></i>Services</a></li>
                <li class="{{ Str::contains(Request::url(), 'reports') ? 'active' : "" }}"><a href="{{ url('admin/reports/') }}"> <i class="fa fa-line-chart" aria-hidden="true"></i>Reports</a></li>
                <li class="{{ Str::contains(Request::url(), 'reviews') ? 'active' : "" }}"><a href="{{ url('admin/reviews/') }}"> <i class="fa fa-comments-o" aria-hidden="true"></i>Reviews</a></li>
                <li class="{{ Str::contains(Request::url(), 'users') ? 'active' : "" }}"><a href="{{ url('admin/users/') }}"> <i class="fa fa-id-card-o" aria-hidden="true"></i>Users</a></li>
                <li class="{{ Str::contains(Request::url(), 'equipments') ? 'active' : "" }}"><a href="{{ url('admin/equipments/') }}"> <i class="fa fa-cogs" aria-hidden="true"></i>Equipments</a></li>
                <!--li class="{{ Str::contains(Request::url(), 'reports') ? 'active' : "" }}"><a href="{{ url('admin/reports/') }}"> <i class="fa fa-line-chart" aria-hidden="true"></i>Reports</a></li-->
                <li><a href="{{ url('/dashboard') }}"> <i class="fa fa-tachometer" aria-hidden="true"></i>Pros View</a></li>
            </ul>
            @endif
            <!--/ MAIN NAVBAR -->
        </nav>
        <!-- / Sidebar Navigation-->
      
      <div class="page-content">
          
          @yield('content')

        <!-- RODAPÉ -->
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">2020 &copy; Truck Easy Moving & Services </p>
            </div>
          </div>
        </footer>
        <!-- / RODAPÉ -->


      </div>
    </div>
    <!-- JavaScript files-->
    <script src="/resources/vendor/jquery/jquery.min.js"></script>
    <script src="/resources/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="/resources/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/resources/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="/resources/vendor/chart.js/Chart.min.js"></script>
    <script src="/resources/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/resources/js/charts-home.js"></script>
    <script src="/resources/js/jquery.magnific-popup.min.js"></script>
    <script src="/resources/js/front.js"></script>
  </body>
</html>
