<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


<div class="main-navbar shadow-sm sticky-top bg-or ange">
    <div class="top-navbar py-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Brand -->
                <div class="col-md-3 d-none d-md-block">
                    <div class="logo-brand">
                        <img src="{{asset('asset/img/logo.png')}}" class="logo-img">
                        <h5 class="brand-name text-white m-0">Fataste</h5>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-md-6">
                    <form role="search">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search your product">
                            <button class="btn btn-light" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Cart / Wishlist / User -->
                <div class="col-md-3">
                    <ul class="nav justify-content-end align-items-center gap-2">
                        @guest
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('login') }}">
            <i class="fa fa-sign-in"></i> Login
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('register') }}">
            <i class="fa fa-user-plus"></i> Register
        </a>
    </li>
@else
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            <i class="fa fa-user"></i> {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> My Orders</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> My Wishlist</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="fa fa-sign-out"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </li>
@endguest

                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand d-md-none" href="#">Fataste</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ url('/')}}" class="nav-link text-white" >
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/collections')}}" class="nav-link text-white">
                            <i class="bi bi-bookmark me-1"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                                <i class="fa fa-shopping-cart"></i> Cart (0)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <i class="fa fa-heart"></i> Wishlist (0)
                            </a>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
    
</div>
