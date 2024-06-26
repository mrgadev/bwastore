<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="/style/main.css" rel="stylesheet" />
    @stack('addon-style')
  </head>
  <body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
          <!-- Sidebar -->
           <div class="border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-center">
              <img src="/images/logo-dashboard.svg" alt="" class="my-4">
            </div>
            <div class="list-group list-group-flush">
              <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action {{(request()->is('dashboard')) ? 'active' : ''}}">Dashboard</a>
              <a href="{{route('dashboard-products')}}" class="list-group-item list-group-item-action {{(request()->is('dashboard/products*')) ? 'active' : ''}}">My Product</a>
              <a href="{{route('dashboard-transactions')}}" class="list-group-item list-group-item-action {{(request()->is('dashboard/transactions*')) ? 'active' : ''}}">Transactions</a>
              <a href="{{route('dashboard-settings-store')}}" class="list-group-item list-group-item-action {{(request()->is('dashboard/settings*')) ? 'active' : ''}}">Store Settings</a>
              <a href="{{route('dashboard-settings-account')}}" class="list-group-item list-group-item-action {{(request()->is('dashboard/account*')) ? 'active' : ''}}">My Account</a>
              <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="bg-transparent text-danger list-group-item list-group-item-action">Logout</button>
              </form>
            </div>
           </div>
          <!-- Page Content Wrapper -->
           <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
              <div class="container-fluid d-flex">
                <button class="btn btn-secondary d-md-none  mr-2" id="menu-toggle">&laquo; Menu</button>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                  <span class="navbar-toggler-icon">
        
                  </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Desktop Menu -->
                  <ul class="navbar-nav d-none d-lg-flex ml-auto">
                    <li class="nav-item dropdown">
                      <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <img src="/images/Foto Profil Baru (Compressed).png" alt="" class="rounded-circle mr-2 profile-picture">
                        Howdy, {{Auth::user()->name}}
                      </a>
                      <div class="dropdown-menu">
                        <a href="{{route('dashboard')}}" class="dropdown-item">Dashboard</a>
                        <a href="{{route('dashboard-settings-account')}}" class="dropdown-item">Settings</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{route('logout')}}" method="POST">
                          @csrf
                          @method('POST')
                          <button class="dropdown-item text-danger d-flex align-items-center gap-3"><span class="material-symbols-rounded">logout</span>Logout</button>
                        </form>
                      </div>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('cart')}}" class="nav-link d-inline-flex align-items-center mt-2">
                        <span class="material-symbols-rounded">shopping_bag</span>
                        @php
                            $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                        @endphp
                        @if ($carts > 0)
                            
                        @endif
                        <span class="cart-badge bg-success rounded px-2 text-white">{{$carts}}</span>
                    </a>
                    </li>
                  </ul>
                  <!-- Mobile Menu -->
                  <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                      <a href="#" class="nav-link">Howdy, Rizqi!</a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('cart')}}" class="nav-link ">Cart</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
            <!-- Section content -->
            @yield('content') 
           </div>
        </div>
      </div>
    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script>
      $('#menu-toggle').click(function(e) {
        e.preventDefault();
        $('#wrapper').toggleClass('toggled');
      });
    </script>
    @stack('addon-script')
  </body>
</html>
