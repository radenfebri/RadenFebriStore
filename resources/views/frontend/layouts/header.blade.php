
<header id="home">
    
    <nav class="navbar navbar-default navbar-sticky bootsnav shadow-less">
        
        <div class="top-search">
            <div class="container">
                <form action="{{ route('searchproduk') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" id="search_produk" name="produk_name" placeholder="Search Produk">
                        <button type="submit" hidden></button>
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="container">
            
            @guest
            <div class="attr-nav circle-item">
                <ul>
                    <li class="search"><a href="#"><i class="fas fa-search"></i></a></li>
                    <li class="dropdown">
                        <a href="{{ route('cart.view') }}" class="dropdown-toggle" data-toggle="dropdown" >
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                    <li class="login">
                        <a href="{{ route('favorit.view') }}"><i class="fa fa-heart"></i>
                        </a>
                    </li>
                    <li class="login">
                        <a href="{{ route('cart.view') }}" class="dropdown-toggle" data-toggle="dropdown" >
                            <i class="fa fa-bell"></i>
                        </a>
                    </li>
                </ul>
            </div>  
            @else
            <div class="attr-nav circle-item">
                <ul>
                    <li class="search"><a href="#"><i class="fas fa-search"></i></a></li>
                    <li class="dropdown">
                        <a href="{{ route('cart.view') }}" class="dropdown-toggle" data-toggle="dropdown" >
                            <i class="fa fa-shopping-cart"></i>
                            <span class="badge cart-count">0</span>
                        </a>
                    </li>
                    <li class="login">
                        <a href="{{ route('favorit.view') }}"><i class="fa fa-heart"></i>
                            <span class="badge wish-count">0</span>
                        </a>
                    </li>
                    <li class="login">
                        <a href="{{ route('cart.view') }}" class="dropdown-toggle" data-toggle="dropdown" >
                            <i class="fa fa-bell"></i>
                            <span class="badge">0</span>
                        </a>
                    </li>
                </ul>
            </div>  
            @endguest
            
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('landing.index') }}">
                    <img src="{{ asset('front') }}/img/logo.png" class="logo" alt="Logo">
                </a>
            </div>
            
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-center" data-in="#" data-out="#">
                    <li><a href="{{ route('landing.index') }}"><i class="fas fa-home"></i> Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-shopping-cart"></i> Shop</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('semuaproduk') }}">Semua Produk</a></li>
                            <li><a href="{{ route('semuakategori') }}">Kategori Produk</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fas fa-phone"></i> contact</a></li>
                    <li class="dropdown">
                        @guest
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fas fa-user"></i> Auth</a>
                        <ul class="dropdown-menu">
                            @if (Route::has('login'))
                            <li><a href="{{ route('login') }}">Login</a></li>
                            @endif
                            @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Regsiter</a></li>
                            @endif
                        </ul>
                        @else
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fas fa-user"></i> {{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li class="d-xl-none d-sm-none"><a href="{{ route('favorit.view') }}">Favorit <span class="badge cart-count">0</span></a></li>
                            <li><a href="{{ route('myorder.index') }}">Order <span class="badge order-count">0</span></a></li>
                            <li><a href="{{ route('settingprofile') }}">Setting</a></li>
                            @if (Route::has('logout'))
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a></li>
                                @endif
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                
                            </ul>
                            @endguest
                        </li>
                        @guest
                            
                        @else
                            @if (Auth::user()->hasRole(['Super Admin', 'Admin']))
                                <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                            @else
                            
                            @endif
                        @endguest

                    </ul>
                </div>
                
                
                
                
            </div>
            
        </nav>
        
        
    </header>
    
    
    