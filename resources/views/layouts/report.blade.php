<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') | WageSweet</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        <br><br>
        <div class="container" id="invoice">
             <h1 style="text-align: center;">WageSweet
                <img src="{{url('/frontend/img/logo1.png')}}" style="width: 7%" height="7%">
             </h1><hr style="border-top: 3px double #8c8c8c;">
             

            <main>
                @yield('content')
            </main>

            <footer style="text-align: right;">
              <h1><small class="text-muted">WageSweet</small></h1>
                        <strong><small class="text-muted">Jl. Nurul Huda No.52 Padaherang, Pangandaran.</small></strong>
                        <div><small class="text-muted">+62 8121 4872 706 | wagesweet@gmail.com</small></div>
                        <div><small class="text-muted">Developed By Melia Wagestu</small></div>
            </footer>
        </div>
        
      </div>

  @stack('modal')
</body>
@stack('js')
<script type="text/javascript">
  window.onload = function() {
    window.print();
  }
</script>

</html>
