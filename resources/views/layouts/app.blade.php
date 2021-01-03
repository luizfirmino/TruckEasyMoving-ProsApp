<!doctype html>
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
                        
                        <!--div class="list-inline-item dropdown">
                            <a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle">
                                <i class="icon-email"></i>
                                <span class="badge dashbg-1">1</span>
                            </a>

                            <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages">
                                <a href="#" class="dropdown-item message d-flex align-items-center">
                                    <div class="profile"><img src="img/avatar-2.jpg" alt="..." class="img-fluid">
                                        <div class="status online"></div>
                                    </div>

                                    <div class="content">   
                                        <strong class="d-block">Luiz Firmino</strong>
                                        <span class="d-block">lorem ipsum dolor sit amit</span>
                                        <small class="date d-block">9:30am</small>
                                    </div>
                                </a>
                            </div>
                        </div-->
                    </div>
                        
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
                
                <!-- /Navbar topo DIRETO (links de acesso rápido)-->


            </div>
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
           
            <span class="heading">Main</span>
            <!-- Avatar Header-->

            <!-- MAIN NAVBAR -->
            <ul class="list-unstyled">
                
                <li class="{{ Str::contains(Request::url(), ['dashboard','jobToday','jobUpcoming']) ? 'active' : '' }}"><a href="{{ url('/dashboard') }}"> <i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard </a></li>
                <li class="{{ Str::contains(Request::url(), ['jobs','jobdetails']) ? 'active' : "" }}"><a href="{{ url('jobs/') }}"> <i class="fa fa-tasks" aria-hidden="true"></i>Past Jobs</a></li>
                <li class="{{ Str::contains(Request::url(), 'jobReplacement') ? 'active' : "" }}"><a href="{{ route('jobReplacement.index') }}"> <i class="fa fa-exchange" aria-hidden="true"></i>Replacements</a></li>
                <li class="{{ Str::contains(Request::url(), 'myAccount') ? 'active' : "" }}"><a href="{{ url('myAccount/') }}"> <i class="fa fa-user-o" aria-hidden="true"></i>My Account</a></li>
                @if (App\User::admin()) 
                    <li class="{{ Request::is("admin") ? "active" : "" }}"><a href="{{ url('admin/') }}"> <i class="fa fa-superpowers" aria-hidden="true"></i>Admin</a></li>
                @endif
            </ul>
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
              <p class="no-margin-bottom">2020 &copy; Powered by <a href="https://www.prohero.net" target="_blank"><i class="fa fa-shield" aria-hidden="true"></i> Pro Hero</a> </p>
            </div>
          </div>
        </footer>
        <!-- / RODAPÉ -->


      </div>
    </div>
    
    <div id="loaderWrapper">
	   <div class="loader"></div>
    </div>
    
    <!-- JavaScript files-->
    <script src="/resources/vendor/jquery/jquery.min.js"></script>
    <script src="/resources/vendor/popper.js/umd/popper.js"></script>
    <script src="/resources/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/resources/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="/resources/vendor/chart.js/Chart.min.js"></script>
    <script src="/resources/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/resources/js/charts-home.js"></script>
    <script src="/resources/js/jquery.magnific-popup.min.js"></script>
    <script src="/resources/js/front.js"></script>
  </body>
</html>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
