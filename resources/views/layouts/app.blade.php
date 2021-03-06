<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BlogApp') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="{{asset('css/fontastic.css')}}">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <!-- Fancybox-->
    <link rel="stylesheet" href="{{asset('vendor/@fancyapps/fancybox/jquery.fancybox.min.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    
    <script src="{{asset('js/front.js')}}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">
      <!-- Main Navbar-->
      <nav class="navbar navbar-expand-lg">
        <div class="search-area">
          <div class="search-area-inner d-flex align-items-center justify-content-center">
            <div class="close-btn"><i class="icon-close"></i></div>
            <div class="row d-flex justify-content-center">
              <div class="col-md-8">
                <form action="#">
                  <div class="form-group">
                    <input type="search" name="search" id="search" placeholder="What are you looking for?">
                    <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <!-- Navbar Brand -->
          <div class="navbar-header d-flex align-items-center justify-content-between">
            <!-- Navbar Brand --><a href="{{route('welcome')}}" class="navbar-brand">{{ config('app.name', 'BlogApp') }}</a>
            <!-- Toggle Button-->
            <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
          </div>
          <!-- Navbar Menu -->
          <div id="navbarcollapse" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{route('welcome')}}" class="nav-link ">Home</a>
                </li>
                <li class="nav-item"><a href="{{route('about')}}" class="nav-link active ">About App</a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        @if (Auth::user()->is_admin > 0)
                          <a class="nav-link" href="{{ route('admin.home') }}">{{ Auth::user()->name }}</a>
                        @else
                          <a class="nav-link" href="{{ route('home') }}">{{ Auth::user()->name }}</a>
                        @endif
                    </li>
                @endguest
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="container">
      <div class="row">
        <!-- Latest Posts -->
        @yield('content')
        <!-- Latest Posts -->
        <aside class="col-lg-4">
            <!-- Widget [Search Bar Widget]-->
            <div class="widget search">
                <header>
                    <h3 class="h6">Search the blog</h3>
                </header>
                <form action="/search" class="search-form">
                    @csrf
                    <div class="form-group">
                    <input type="search" name="search" id="search" placeholder="What are you looking for?">
                    <button type="submit" class="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <!-- Widget [Categories Widget]-->
            <div class="widget categories">
                <header>
                    <h3 class="h6">Categories</h3>
                </header>
            </div>
          </aside>
        </div>
      </div>
      <!-- Page Footer-->
      <footer class="main-footer">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="logo">
                <h6 class="text-white">{{ config('app.name', 'BlogApp') }}</h6>
              </div>
              <div class="contact-details">
                <p>53 Broadway, Broklyn, NY 11249</p>
                <p>Phone: (020) 123 456 789</p>
                <p>Email: <a href="mailto:info@company.com">Info@Company.com</a></p>
                <ul class="social-menu">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="menus d-flex">
                
              </div>
            </div>
            <div class="col-md-4">
              <div class="latest-posts"><a href="#"></div>
            </div>
          </div>
        </div>
        <div class="copyrights">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <p>&copy; 2020. All rights reserved. Kodyfy</p>
              </div>
              <div class="col-md-6 text-right">
                <p>Template By <a href="https://bootstrapious.com/p/bootstrap-carousel" class="text-white">Bootstrapious</a>
                  <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
                </p>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- JavaScript files-->
      <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('vendor/popper.js/umd/popper.min.js')}}"> </script>
      <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
      <script src="{{asset('vendor/@fancyapps/fancybox/jquery.fancybox.min.js')}}"></script>
    </body>
  </html>