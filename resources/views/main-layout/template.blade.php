<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Phoenix Jewellery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" type="text/css" href="{{ url('assets/logo/icon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mainContent.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile-wishlist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href={{ asset('css/adminlte.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/mainLogin.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/utilLogin.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/footer.css') }}>


  </head>

  <style type="text/css">
    body{
          background-color: #eaded2;
          background: url(../assets/Background/background.png);
          background-repeat: repeat-y;
          background-size:100%;
          background-position: bottom;
          background-attachment: fixed;
        }
  </style>
  <body>

  <div class="site-wrap">
    <header class="site-navbar" role="banner" style="background-color: black">
      <div class="site-navbar-top">
        <div class="container">
          <div class="col-12 col-md-12 order-4 order-md-4 text-right">
            <div class="site-top-icons">
              <ul>
                @if (Sentinel::check())
                <li class="mr-2"><a href="{{ url('/Profile-User') }}" data-toggle="tooltip" data-placement="top" title="PROFILE">
                  <span class="icon icon-person" style="font-size:30px;"></span></a>
                </li>
                <li class="mr-2"><a href="{{ url('/Wishlist') }}" class="site-wishlist" data-toggle="tooltip" data-placement="top" title="WISHLIST">
                  <span class="icon icon-heart-o" style="font-size:30px;"></span>
                  <span class="count">{{ $wishlistcount }}</span></a>
                </li>
                <li class="mr-2"><a href="{{ url('/Cart') }}" class="site-cart" data-toggle="tooltip" data-placement="top" title="CART">
                    <span class="icon icon-shopping_cart" style="font-size:30px;"></span>
                    <span class="count">{{Cart::getContent()->count()}}</span></a>
                </li>
                @endif
                <li class="d-inline-block d-md-none ml-md-0">
                  <a href="#" class="site-menu-toggle js-menu-toggle">
                    <span class="icon-menu"></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-12 col-md-12 order-3 order-md-3 site-search-icon text-left">
              <form action="{{ route('search.product') }}" method="GET" class="site-block-top-search search-form">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" id="filter" name="filter" value="{{ request()->input('filter') }}" placeholder="Search...">
              </form>
            </div>
            <div id="logo">
              <div class="site-logo">
                <img src="{{ asset('assets/logo/Logo.png') }}" alt="">
              </div>
            </div>
          </div>
        </div>
        <br/>
        <nav class="site-navigation text-right text-md-center" role="navigation">
          <div class="container">
            <ul class="site-menu js-clone-nav d-none d-md-block">
              <li class="active"><a href="/">Home</a></li>
              <li class="has-children">
                <a href="#">Product</a>
                <ul class="dropdown">
                  <li class="has-children">
                    <a href="#">Product</a>
                    <ul class="dropdown">
                      <li><a href="{{ url('/Product-All-Man') }}">Man</a></li>
                      <li><a href="{{ url('/Product-All-Woman') }}">Woman</a></li>
                      <li><a href="{{ url('/Product-All-Child') }}">Children</a></li>
                      <li><a href="{{ url('/Product-All-Universal') }}">Universal</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url('/Product-Bundle') }}">Bundle</a></li>
                  <li><a href="{{ url('/Customize-Product') }}">Customize</a></li>
                  <li><a href="{{ url('/Special-Product') }}">Special Product</a></li>
                </ul>
              </li>
              <li><a href="{{ url('/Try-Something-New') }}">Try Something New</a></li>
              <li><a href="{{ url('/Faq') }}">FAQ</a></li>
              @if(Sentinel::check())
                <li>
                  <form action="{{ url('/logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="document.getElementById('logout-form').submit()" data-toggle="tooltip" data-placement="top" title="LOGOUT">
                      <span style="font-size:25px;">Logout</span>
                    </a>
                  </form>
                </li>
              @else
                <li><a href="/login">Sign In</a></li>
              @endif
            </ul>
          </div>
        </nav>
      </div>
    </header>

    <main class="pb-4">
      @yield('content')
    </main>

    <footer class="site-footer">
      <div class="container">
        <div class="col-md-12 text-center">
          <h1 class="mb-4 text-bold">Contact Us</h1>
        </div>
        <div class="footerWrapper">
          <div class="  ">
            <a href="https://m.facebook.com/ask.phoenixjewel/?tsid=0.8357089745281052&source=result" target="_blank">
              <img src="{{ asset('assets/Icon/fb.png') }}" alt="">
            </a>
          </div>
          <div class="  ">
            <a href="https://www.instagram.com/phoenixjewelleryid/" target="_blank">
              <img src="{{ asset('assets/Icon/IG.png') }}" alt="">
            </a>
          </div>
          <div class="  ">
            <a href="https://m.tokopedia.com/phoenixjewellery/home" target="_blank">
              <img src="{{ asset('assets/Icon/tokped1.png') }}" alt="">
            </a>
          </div>
        </div>
      </div>
    </footer>

    <div class="col-md-12 mb-2 text-center">
      <ul>
        <li>
          <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script data-cfasync="false" src=""></script><script>document.write(new Date().getFullYear());</script> All rights reserved</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </li>
      </ul>
    </div>

  </div>


  <script src="https://use.fontawesome.com/9504c33a58.js"></script>
  <script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ url('js/owl.carousel.min.js') }}"></script>
  <script src="{{ url('js/jquery-ui.js') }}"></script>
  <script src="{{ url('js/popper.min.js') }}"></script>
  <script src="{{ url('js/bootstrap.min.js') }}"></script>
  <script src="{{ url('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ url('js/aos.js') }}"></script>
  <script src="{{ url('js/main.js') }}"></script>
  <script src="{{ asset('js/lightbox-plus-jquery.min.js')}}"></script>
  {{-- <script src="{{ url('js/sliderTrySomeNew.js') }}"></script> --}}

  </body>
</html>