<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>
      @yield('title')
    </title>

    <link href="{{ asset('css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
      <div class="container">

        <div class="navbar-left">
          <button class="navbar-toggler" type="button">&#9776;</button>
          <a class="navbar-brand" href="{{ route('welcome') }} ">
            LaravelBlog
          </a>
        </div>

        <section class="navbar-mobile">
          <span class="navbar-divider d-mobile-none"></span>

          <ul class="nav nav-navbar">

          </ul>
        </section>

        <a class="btn btn-xs btn-round btn-success" href="{{ route('login') }}">LogIn</a>

      </div>
    </nav>


    @yield('header')

    @yield('content')


    <footer class="footer">
      <div class="container">
        <div class="row gap-y align-items-center">

          <div class="col-6 col-lg-3">
            <a href="{{ route('welcome') }}" style="color: black;">
              LaravelBlog
            </a>
          </div>

          <div class="col-6 col-lg-3 text-right order-lg-last">
            <div class="social">
            </div>
          </div>
          
        </div>
      </div>
    </footer>


    <script src="{{ asset('js/page.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5da84c6d5e47384c"></script>

  </body>
</html>
