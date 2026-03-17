<?php
$void = "javascript:void(0)";
$isDevMode = false;
?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>@yield('title') | Sender 26</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

   <!-- CSS here -->
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/swiper-bundle.css">
   <link rel="stylesheet" href="css/magnific-popup.css">
   <link rel="stylesheet" href="css/font-awesome-pro.css">
   <link rel="stylesheet" href="lib/sweet-alert/sweetalert2.css">
   <link rel="stylesheet" href="css/mmm.css?ver={{rand(999, 9999999)}}">

   @yield('styles')
</head>




<?php
$v = isset($isDashboard) && $isDashboard;
$headerClass = $v ? "fixed fullwidth_block dashboard" : "fullwidth";
$headerDivClass = $v ? "not-sticky":"";
$isLoggedIn = isset($user);
$isAdmin = $isLoggedIn && ($user->role === 'admin' || $user->role === 'su');
$bday = $isLoggedIn ? $user->bday : ''; 
?>

<body class="tp-magic-cursor loaded">

<!--[if lte IE 9]>
     <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->






  
  <header>

     <!-- tp-header-area-start -->
     <div id="header-sticky" class="tp-header-area pre-header sticky-white-bg tp-header-blur header-transparent tp-header-lg-spacing">
        <div class="container-fluid container-1800">
           <div class="row align-items-center">
              <div class="col-12">
              <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{url('/')}}">Sender 26</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
        </li>
       <li class="nav-item dropdown">
         @if($isLoggedIn)
         <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome back, {{$user->username}}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('profile')}}">Profile</a></li>
            <li><a class="dropdown-item" href="{{url('smtp')}}">SMTP settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{url('bye')}}">Sign out</a></li>
          </ul>
         @else
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome,
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('login')}}">Login</a></li>
            <li><a class="dropdown-item" href="{{url('apply')}}">Apply</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Version: 2.0.1</a></li>
          </ul>
         @endif
          
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
              </div>
           </div>
        </div>
     </div>
     <!-- tp-header-area-end -->
      
  </header>

        <main>
           @yield('content')

            <!-- tp-footer area start -->
         <div class="fixed-bottom">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12">
                    
                  </div>
               </div>
            </div>
         </div>
            <!-- tp-footer area end -->
        </main>

        


   <!-- JS here -->
   <script src="js/jquery.js"></script>
   <script src="js/bootstrap-bundle.js"></script>
   <script src="js/helpers.js?ver={{rand(999, 9999999)}}"></script>
   


   
   @yield('scripts')

   <script src="lib/sweet-alert/sweetalert2.js"></script>

    <!--------- Session notifications: : DO NOT EDIT -------------->
 <?php
$pop = "";
$val = "";

if (isset($signals)) {
    foreach ($signals['okays'] as $key => $value) {
        if (session()->has($key)) {
            $pop = $key;
            $val = session()->get($key);
        }
    }
}
             ?> 

                 @if($pop != "" && $val != "")
                   @include('session-status', ['pop' => $pop, 'val' => $val])
                 @endif


<!--------- Plugins: DO NOT EDIT ------>
<?php
    foreach ($plugins as $p) {
?>
{!! $p['value'] !!}
<?php
    }
?>
<!------------------------------------->
</body>

</html>