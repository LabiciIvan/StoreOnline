<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/userApp.css') }}">
  <link rel="stylesheet" href="{{ asset('css/contact.style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cartStyle.css') }}">
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/show.style.css') }}">
</head>
<body class="">
  

  <div class="navigation-bar-shop"  >
  @include('layouts.userNavigation')
  </div>
  @yield('content')
 
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/test.js') }}"></script>
  <script src="{{ asset('js/scriptCart.js') }}"></script>
  <script src="{{ asset('js/index.script.js') }}"></script>
  <script src="https://kit.fontawesome.com/7784d1bec6.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/checkout.script.js') }}"></script>
</body>
</html>