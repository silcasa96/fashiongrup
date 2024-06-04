<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/login/font-style.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/login/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dist/login/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('dist/login/style.css') }}">

      <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/images/logo-sjp.jpg') }}">

    <title>ERP || ES-iOS</title>
  </head>
  <body>
  
    @yield('content')

    
    <script src="{{ asset('dist/login/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('dist/login/popper.min.js') }}"></script>
    <script src="{{ asset('dist/login/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/login/main.js') }}"></script>
  </body>
</html>