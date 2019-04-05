<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title',$title)</title>
    <meta name="description" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @foreach($icon as $i)
        <link rel="shortcut icon" href="/storage/image/{{$i->image}}">

    @endforeach


    <link rel="apple-touch-icon" href="{{asset('assets/images/icon.png')}}">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <script src="{{asset('assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <style>

    </style>

    @yield('style')
</head>
<body>




<div class="wrapper" id="wrapper">

    <header id="wn__header" class="header__area header__absolute sticky__header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                    <div class="logo">
                        <a href="/">
                            @foreach($icon as $i)
                            <img src="/storage/image/{{$i->image}}" alt="logo images" size="20px">
                                @endforeach
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                    <nav class="mainmenu__nav">
                        <ul class="meninmenu d-flex justify-content-start">
                            <li class="drop with--one--item"><a href="/">Home</a></li>
                            @foreach($categorys as $cat)
                            <li class="drop"><a>{{$cat->main_category}}</a>
                                <div class="megamenu mega03"  >
                                    <?php $i = 1; ?>
                                    @foreach($cat->subcategory as $sub)
                                        @if($sub->confirmed == 1)
                                        <ul class="item item03">
                                            <li class="title"><h6>{{$sub->sub_category}}</h6></li>
                                            @foreach($sub->minicategory as $mini)
                                                @if($mini->confirmed == 1)
                                                    <li><a href="{{route('get.minicategory',[$mini->id])}}">{{$mini->mini_category}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        @endif

                                        <?php $i++; ?>
                                    @endforeach
                                </div>
                            </li>
                            @endforeach
                            <li><a href="/contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                    <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                        <li class="shop_search"><a class="search__active" href="#"></a></li>
                        <li class="wishlist"><a href="#"></a></li>
                        <li class="shopcart"><a href="{{route('pending')}}"><span class="product_qun">{{$count}}</span></a>
                        </li>
                        <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                            <div class="searchbar__content setting__block">
                                <div class="content-inner">
                                    <div class="switcher-currency">

                                        <div class="switcher-options">
                                            <div class="switcher-currency-trigger">
                                                <div class="setting__menu">
                                                    @guest
                                                    <span><a href="/login">Sign In</a></span>
                                                        @if (Route::has('register'))
                                                    <span><a href="/register">Create An Account</a></span>
                                                        @endif
                                                    @else
                                                        <strong class="label switcher-label">
                                                            <span> <a>{{ Auth::user()->name }}</a>   </span>
                                                        </strong>
                                                            <span><a href="{{route('home')}}">My Account</a></span>
                                                          <span><a href="#">My Wishlist</a></span>
                                                        <span>
                                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                            </a></span>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                             @csrf
                                                        </form>

                                                    @endguest
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row d-none">
                <div class="col-lg-12 d-none">
                    <nav class="mobilemenu__nav">
                        <ul class="meninmenu">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#">Pages</a>
                                <ul>
                                    <li><a href="about.html">About Page</a></li>
                                    <li><a href="portfolio.html">Portfolio</a>
                                        <ul>
                                            <li><a href="portfolio.html">Portfolio</a></li>
                                            <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                    <li><a href="error404.html">404 Page</a></li>
                                    <li><a href="faq.html">Faq Page</a></li>
                                    <li><a href="team.html">Team Page</a></li>
                                </ul>
                            </li>
                            <li><a href="shop-grid.html">Shop</a>
                                <ul>
                                    <li><a href="shop-grid.html">Shop Grid</a></li>
                                    <li><a href="single-product.html">Single Product</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.html">Blog</a>
                                <ul>
                                    <li><a href="blog.html">Blog Page</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="mobile-menu d-block d-lg-none">
            </div>

        </div>
    </header>


    <div class="brown--color box-search-content search_active block-bg close__top">
        <form id="search_mini_form" class="minisearch" action="{{route('search')}}" method="get">
            <div class="field__search">
                <input type="text" name="search" placeholder="Search Name Of Book From Hear...">
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
</div>

    @yield('content')


<!-- Footer -->
<footer style="margin-top:8%;">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-5 footer-about wow fadeInUp">
                    <h5 style="color: #505050; margin-bottom: 9%;">About Us </h5>
                    @foreach($contact as $c)
                    <p style="color: #303030">
                       {{$c->about_us}}
                    </p>
                    @endforeach
                    <!--	<p>&copy; E-library.</p> -->
                </div>
                <div class="col-md-3 footer-links wow fadeInUp">
                    <div class="row">
                        <div class="col">
                            <h5 style="color: #606060; margin-bottom: 9%;">Quick Links</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color: #606060"><a class="scroll-link" href="/">Home</a></p>
                            <p><a href="{{route('Contact')}}">Contact Us</a></p>
                            <p><a href="{{route('about.us')}}">About Us</a></p>
                            <p><a href="#">How It Works</a></p>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 footer-links wow fadeInUp">
                    <div class="row">
                        <div class="col">
                            <h5 style="color: #606060; margin-bottom: 9%;">Help & Information</h5>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <p><a href="{{route('Plan')}}">Plans &amp; pricing</a></p>
                            <p><a href="{{route('Term')}}">Terms & Conditions</a></p>
                            <p><a href="{{route('Privacy')}}">Privacy Policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright__wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12" style="padding-top: 50px;">
                    <div class="copy__right__inner text-left">
                        <p style="font-size: 13px; font-style: italic"><a href="https://elibrary.com/">Designed by Prime IT Sewa. All Rights Reserved &copy; 2019</a></p>
                    </div>
                </div>
                <div class="row" style="padding-top:50px;">
                    <div class="footer__content" style="margin-right:20px;" >
                        <ul class="social__net social__net--2 d-flex justify-content-center">
                            @foreach($contact as $c)
                            <li><a href="{{$c->facebook}}"><i class="bi bi-facebook"></i></a></li>
                            <li><a href="{{$c->gmail}}"><i class="bi bi-google"></i></a></li>
                            <li><a href="{{$c->twitter}}"><i class="bi bi-twitter"></i></a></li>
                            <li><a href="{{$c->linkedin}}"><i class="bi bi-linkedin"></i></a></li>
                            <li><a href="{{$c->youtube}}"><i class="bi bi-youtube"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="payment text-right">
                            <img src="{{asset('/assets/images/icons/payment.png')}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>


<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

<script src="{{ asset('assets/js/vendor/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('assets/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins.js')}}"></script>
<script src="{{asset('assets/js/active.js')}}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
<script
    src="http://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        setTimeout(function(){
            $('.alert').hide('slow');
        },2000);
    });
</script>
@yield('script')

</body>
</html>
