<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/resources/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/resources/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="/resources/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/resources/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/resources/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->    
    
    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    
    <script>
      const beamsClient = new PusherPushNotifications.Client({
        instanceId: 'a07f894e-3b93-47ed-bf05-e9dd400fc591',
      });

      beamsClient.start()
        .then(() => beamsClient.addDeviceInterest('hello'))
        .then(() => console.log('Successfully registered and subscribed!'))
        .catch(console.error);
    </script>
    
</head>
<body>
    <div class="login-page">
          <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
              <div class="row">


                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                  <div class="info d-flex align-items-center">
                    <div class="content w-100 text-center">
                      <div class="logo">
                        <img src="/resources/img/truck-easy-logo.png" alt="">
                      </div>
                      <p>Pros Exclusive Area</p>
                    </div>
                  </div>
                </div>
                <!--/ Logo & Information Panel-->

                <!-- Form Panel -->
                <div class="col-lg-6">
                  <div class="form d-flex align-items-center">
                    <div class="content">
                        @yield('content')
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
              <p class="no-margin-bottom">2020 &copy; Powered by <a href="https://www.prohero.net" target="_blank"><i class="fa fa-shield" aria-hidden="true"></i> Pro Hero</a> </p>
            </div>
          </div>
        </footer>
        <!-- / RODAPÉ -->
        
        <!-- JavaScript files-->
        <script src="/resources/vendor/jquery/jquery.min.js"></script>
        <script src="/resources/vendor/popper.js/umd/popper.min.js"> </script>
        <script src="/resources/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="/resources/vendor/jquery.cookie/jquery.cookie.js"> </script>
        <script src="/resources/vendor/chart.js/Chart.min.js"></script>
        <script src="/resources/vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="/resources/js/front.js"></script>
    
    </body>
</html>
