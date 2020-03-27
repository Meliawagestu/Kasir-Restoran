<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>WageSweet</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('frontend/img/logo1.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{url('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/style.css')}}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head> 

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
<header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-lg-10">
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul class="mein_menu_list" id="navigation">
                                        <li><a href="{{ route('menu-masakan') }}"><strong>Home</strong></a></li>
                                        <li><a href="{{ route('about') }}"><strong>About</strong></a></li>
                                        <li><a href="#"><strong>Menu</strong> <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li>
                                                    <?php 
                                                        $data=DB::table('tbl_kategori')->get();
                                                        ?>
                                                        @foreach($data as $dt)
                                                        <a href="{{route('show.category', ['id' => $dt->id])}}">{{ $dt->nama_kategori}}</a>
                                                        @endforeach
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="{{route('history')}}"><strong>History</strong>{{Session::has('history') ? Session::get('history')->totalQty : ''}}</a></li>

                                        <li><i class="fa fa-cart-plus" aria-hidden="true"></i><a href="{{route('shopping.cart')}}"><strong>Cart</strong> <span class="badge badge-warning">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span></a></li>

                                        <li><a href="#"><strong>{{ Auth::user()->name }}</strong> <i class="ti-angle-down"></i></a>
                                            <ul class="submenu" style="text-align: center;">
                                             <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); 
                                                    document.getElementById('logout-form').submit();">
                                                    <strong> Logout</strong>
                                                </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                           {{ csrf_field() }}</form>
                                            </li>  
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    @yield('content')
    
    <!-- footer-start -->
    <footer class="footer_area footer-bg zigzag_bg_1">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-md-12 col-lg-8">
                        <div class="copyright">
                                <p class="footer-text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Melia Wagestu</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-12 col-lg-4">
                        <div class="social_links">
                            <ul>
                                <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                                <li><a href="#"> <i class="fa fa-twitter"></i> </a></li>
                                <li><a href="#"> <i class="fa fa-dribbble"></i> </a></li>
                                <li><a href="#"> <i class="fa fa-behance"></i> </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-end -->


    <!-- JS here -->
    <script src="{{url('frontend/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <script src="{{url('frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{url('frontend/js/popper.min.js')}}"></script>
    <script src="{{url('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{url('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{url('frontend/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{url('frontend/js/ajax-form.js')}}"></script>
    <script src="{{url('frontend/js/waypoints.min.js')}}"></script>
    <script src="{{url('frontend/js/jquery.counterup.min.js')}}"></script>
    <script src="{{url('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{url('frontend/js/scrollIt.js')}}"></script>
    <script src="{{url('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{url('frontend/js/wow.min.js')}}"></script>
    <script src="{{url('frontend/js/nice-select.min.js')}}"></script>
    <script src="{{url('frontend/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{url('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{url('frontend/js/plugins.js')}}"></script>

    <!--contact js-->
    <script src="{{url('frontend/js/contact.js')}}"></script>
    <script src="{{url('frontend/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{url('frontend/js/jquery.form.js')}}"></script>
    <script src="{{url('frontend/js/jquery.validate.min.js')}}"></script>
    <script src="{{url('frontend/js/mail-script.js')}}"></script>
    <script src="{{url('frontend/js/main.js')}}"></script>

</body>

</html>

