<head>
    <meta charset="utf-8">
    <title>Frozen | Flour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="organic, natural products, Pattoki, Pakistan, skincare, health, wellness">
    <meta name="description" content="FROZEN FLOUR offers a wide range of organic and natural products sourced locally from Pattoki, Pakistan. Quality products for your health and wellness.">

    <!-- Favicon -->
    <link href="{{ asset('favicon_io/favicon.ico') }}" rel="icon" type="image/x-icon">
    <link href="{{ asset('favicon_io/favicon.png') }}" rel="alternate icon" type="image/png">

    <!-- Bootstrap 5 and other libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>


</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <!-- Top Bar Start -->
<div class="top-bar row gx-0 align-items-center text-white d-none d-md-flex" style="background-color: #7F0000">
    <div class="col-md-6 px-5 text-start">

        <small><i class="fa fa-map-marker-alt me-2 text-warning"></i>172/Y/2 PECHS Karachi</small>
        <small class="ms-4"><i class="fa fa-envelope me-2"></i>sales@frozenflour.com</small>
        {{-- <a href="https://wa.me/923158274326" target="_blank" style="display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 5px; background-color: #25D366; color: #fff; text-decoration: none;">
            <i class="fab fa-whatsapp" style="margin-right: 4px;"></i> Open WhatsApp
        </a> --}}
    </div>
    <div class="col-md-6 px-5 text-end">
        <span class="navbar-text fw-bold text-warning">Free shipping over Rs.5,000/-</span>
    </div>
</div>
<!-- Top Bar End -->
        <marquee class="text-white py-1" style="background-color: #7F0000">
            <i class="text-white">FROZEN FLOUR: We take care of your needs.</i>
        </marquee>
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 px-lg-5">
            <a href="{{ route('home') }}" class="navbar-brand ms-4 ms-lg-0">
                <img src="{{ asset('img/logo.jpg') }}" alt="FROZEN FLOUR Logo" class="img-fluid me-3" style="height: 100px;">
            </a>
            <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-2 p-lg-0">
                    {{-- <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'fw-bold' : 'text-success' }}" aria-label="Home">Home</a> --}}
                    <a style="color: #7F0000; {{ request()->routeIs('home') ? 'font-weight: bold;' : 'color: #7F0000;' }}" href="{{ route('home') }}" class="nav-item nav-link" aria-label="Home">Home</a>
                    {{-- <a style="color: #7F0000; " href="{{ route('shop') }}" class="nav-item nav-link {{ request()->routeIs('shop') ? 'fw-bold' : 'text-success' }}" aria-label="Products">Shop</a> --}}

                    <a style="color: #7F0000; {{ request()->routeIs('shop') ? 'font-weight: bold;' : 'color: #7F0000;' }}" href="{{ route('shop') }}" class="nav-item nav-link" aria-label="Shop">Shop</a>

                    <a style="color: #7F0000; {{ request()->routeIs('aboutus') ? 'font-weight: bold;' : 'color: #7F0000;' }}" href="{{ route('aboutus') }}" class="nav-item nav-link" aria-label="About Us">About Us</a>
                    @auth
                        {{-- <a href="{{ route('my.orders') }}" class="nav-item nav-link {{ request()->routeIs('my.orders') ? 'fw-bold' : 'text-success' }}" aria-label="My Orders">My Orders</a> --}}
                        <a style="color: #7F0000; {{ request()->routeIs('my.orders') ? 'font-weight: bold;' : 'color: #7F0000;' }}" href="{{ route('my.orders') }}" class="nav-item nav-link" aria-label="My Order">My Orders</a>
                    @endauth
                    {{-- <a href="{{ route('contactus') }}" class="nav-item nav-link {{ request()->routeIs('contactus') ? 'fw-bold' : 'text-success' }}" aria-label="Contact Us">Contact Us</a> --}}
                    <a style="color: #7F0000; {{ request()->routeIs('contactus') ? 'font-weight: bold;' : 'color: #7F0000;' }}" href="{{ route('contactus') }}" class="nav-item nav-link" aria-label="Contact Us">Contact Us</a>

                    {{-- <a href="{{ route('cart.view') }}" class="nav-item nav-link {{ request()->routeIs('cart.view') ? 'fw-bold' : 'text-success' }}" aria-label="Cart"><i class="bi bi-cart fs-6"></i> Cart</a>
                    --}}
                    <a style="color: #7F0000; {{ request()->routeIs('cart.view') ? 'font-weight: bold;' : 'color: #7F0000;' }}" href="{{ route('cart.view') }}" class="nav-item nav-link" aria-label="Cart"><i class="bi bi-cart fs-6"></i>Cart</a>

                    @if (Auth::check())
                        {{-- <a href="{{ route('user_logout') }}" class="nav-item nav-link {{ request()->routeIs('user_logout') ? 'fw-bold' : 'text-success' }}" aria-label="Log Out"><i class="fas fa-sign-out-alt"></i> Log Out</a> --}}
                        <a style="color: #7F0000; {{ request()->routeIs('user_logout') ? 'font-weight: bold;' : 'color: #7F0000;' }}" href="{{ route('user_logout') }}" class="nav-item nav-link" aria-label="Log Out"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                    @else
                        {{-- <a href="{{ route('user_login') }}" class="nav-item nav-link {{ request()->routeIs('user_login') ? 'fw-bold' : 'text-success' }}" aria-label="Log In"><i class="fas fa-sign-in-alt"></i> Login</a> --}}
                        <a style="color: #7F0000; {{ request()->routeIs('user_login') ? 'font-weight: bold;' : 'color: #7F0000;' }}" href="{{ route('user_login') }}" class="nav-item nav-link" aria-label="Log In"><i class="fas fa-sign-out-alt"></i>Log In</a>
                    @endif
                    @if (Auth::check())
                    <span style="color: #7F0000 !important;" class="navbar-text text-success me-3">
                        Welcome, {{ Auth::user()->name }} <!-- Display the authenticated user's name -->
                    </span>
                    @endif
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
    </div>
    <!-- Navbar End -->

