<?php
$void = "javascript:void(0)";
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="Epic Trade Investment Limited, A Modern Cryptocurrency Investment Platform">
<meta name="keywords" content="investment, Epic Trade Investment limited, Epic Trade Investment">
<link rel="shortcut icon" href="" type="image/x-icon">

<link rel="apple-touch-icon" href="">
<title>@yield('title') | Epic Trade Investment</title>
<!-- Favicon -->
<link rel="shortcut icon" href="images/logo2.jpg" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content=" | Login">

<meta itemprop="name" content=" | Login">
<meta itemprop="description" content="Epic Trade Investment Limited, A Modern Cryptocurrency Investment Platform">
<meta itemprop="image" content="">

<meta property="og:type" content="website">
<meta property="og:title" content="Epic Trade Investment Limited">
<meta property="og:description" content="A Modern Cryptocurrency Investment Platform">

<meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" type="text/css" href="dashboard/bootstrap/bootstrap.min.css" />

      <!--FontAwesome-->
      <link rel="stylesheet" href="lib/fontawesome/font-awesome.min.css?ver={{rand(999, 9999999)}}">
    <!--end of FontAwesome-->
        
    
    <link rel="stylesheet" type="text/css" href="dashboard/plugins/owlcarousel/animate.css">
    <link rel="stylesheet" type="text/css" href="dashboard/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard/plugins/owlcarousel/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard/plugins/aos/aos.css">
    <link rel="stylesheet" type="text/css" href="dashboard/plugins/radial-progress/radialprogress.css">
    <link rel="stylesheet" type="text/css" href="dashboard/scss/flag-icon.min.css" />
    <link rel="stylesheet" type="text/css" href="dashboard/scss/style.css">
    <script src="dashboard/js/modernizr.custom.js"></script>

    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="application/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="application/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
 <!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '02b5ab22dc9b399d35e10d5dfa40de3a8cdd5635';
window.smartsupp||(function(d) {
var s,c,o=smartsuxf=function(){ o._.push(arguments)};o._=[];
s=d.getElementsByTagName('script')[0];c=d.createElement('script');
c.type='text/javascript';c.charset='utf-8';c.async=true;
c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
 <!-- end of Smartsupp Live Chat script -->
    @yield('styles')

    <script src="js/jquery-min.js"></script>
    <script src="js/helpers.js?ver={{rand(999, 9999999)}}"></script>
</head>

<body>
<header id="header-section">
    <div class="overlay">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid ">
                <a class="navbar-brand golden-text" href="{{url('/')}}">
                <img src="images/logo2.jpg" style="height: 40px;"/> 
                <span style="color: #f9b707;">Epic Trade</span>
                </a>
                <button class="navbar-toggler p-0 " type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <img src="dashboard/img/icon/hamburger.png" alt="hamburger image" />
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">

                        <li class="nav-item">
                            <a class="nav-link " href="{{url('login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('signup')}}">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--/ NAVBAR -->
    </div>
</header>

@yield('content')

<!-- scroll top icon -->
<a href="#" class="scroll-top">
    <img src="dashboard/img/icon/up-arrow2.png" alt="scroll to top" />
</a>

<!-- start preloader -->
<div id="preloader">
    <img src="dashboard/img/bitcoin.gif" alt="preloader" class="loader" />
</div>
<!-- end preloader -->


<script src="dashboard/bootstrap/bootstrap.bundle.min.js"></script>
<script src="dashboard/plugins/owlcarousel/owl.carousel.min.js"></script>
<script src="dashboard/plugins/counterup/jquery.waypoints.min.js"></script>
<script src="dashboard/plugins/counterup/jquery.counterup.min.js"></script>
<script src="dashboard/plugins/aos/aos.js"></script>
<script src="dashboard/plugins/radial-progress/radialprogress.js"></script>


<script src="dashboard/js/notiflix-aio-2.7.0.min.js"></script>
<script src="dashboard/js/pusher.min.js"></script>
<script src="dashboard/js/vue.min.js"></script>
<script src="dashboard/js/axios.min.js"></script>
<!-- custom script -->
<script src="dashboard/js/script.js"></script>

@yield('scripts')


</body>
</html>