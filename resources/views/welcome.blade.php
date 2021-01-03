<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Truck Easy Moving - Pros</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Truck Easy Moving & Services</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="resources/vendor/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="resources/vendor/font-awesome/css/font-awesome.min.css">
        <!-- Custom Font Icons CSS-->
        <link rel="stylesheet" href="resources/css/font.css">
        <!-- Google fonts - Muli-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="resources/css/style.default.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="resources/css/custom.css">
        <!-- Favicon-->
        <!--<link rel="shortcut icon" href="img/favicon.ico">-->
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    </head>
    <body>      
        
         <div class="login-page">
          <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
              <div class="row">


                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                  <div class="info d-flex align-items-center">
                    <div class="content">
                      <div class="logo">
                        <img src="resources/img/truck-easy-logo.png" alt="">
                        <h1>Truck Easy Moving & Services</h1>
                      </div>
                      <p>Professionals Exclusive Area</p>
                    </div>
                  </div>
                </div>
                <!--/ Logo & Information Panel-->


                <!-- Form Panel -->
                <div class="col-lg-6">
                  <div class="form d-flex align-items-center">
                    <div class="content">
                        
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}">Login</a><br />

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                        
                            @endauth
                        @endif
                    </div>
                  </div>
                </div>
                <!-- /Form Panel    -->

              </div>
            </div>
          </div>
        </div>

        <!-- RODAPÉ -->
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">2019 &copy; Truck Easy Moving & Services </p>
            </div>
          </div>
        </footer>
        <!-- / RODAPÉ -->



        <!-- JavaScript files-->
        <script src="resources/vendor/jquery/jquery.min.js"></script>
        <script src="resources/vendor/popper.js/umd/popper.min.js"> </script>
        <script src="resources/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="resources/vendor/jquery.cookie/jquery.cookie.js"> </script>
        <script src="resources/vendor/chart.js/Chart.min.js"></script>
        <script src="resources/vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="resources/js/front.js"></script>
        
        
            
    </body>
</html>
