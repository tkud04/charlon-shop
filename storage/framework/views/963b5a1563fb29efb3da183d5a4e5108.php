<?php
$void = "javascript:void(0)";
$isDevMode = false;
?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title><?php echo $__env->yieldContent('title'); ?> | Charlon Shop</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

   <link href="//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic%7CPT+Gudea:400,700,400italic%7CPT+Oswald:400,700,300" rel="stylesheet" id="googlefont">

   <!-- CSS here -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/prettyPhoto.css">
    <link rel="stylesheet" href="css/colpick.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
   <link rel="stylesheet" href="lib/sweet-alert/sweetalert2.css">
   <link rel="stylesheet" href="css/mmm.css?ver=<?php echo e(rand(999, 9999999)); ?>">

   <?php echo $__env->yieldContent('styles'); ?>
</head>




<?php
$v = isset($isDashboard) && $isDashboard;
$isLoggedIn = isset($user);
$isAdmin = $isLoggedIn && ($user->role === 'admin' || $user->role === 'su');
$bday = $isLoggedIn ? $user->bday : ''; 
?>

<body>
  <!--[if lte IE 9]>
     <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<div id='wrapper'>
<header id="header">
        <div id="header-top">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="header-top-left">
                  <?php if($isLoggedIn): ?>
                  <ul id="top-links" class="clearfix">
                    <li>
                      <a href="<?php echo e(url('wishlist')); ?>" title="My Wishlist">
                        <span class="top-icon top-icon-pencil"></span>
                        <span class="hide-for-xs">My Wishlist</span>
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('profile')); ?>" title="My Account">
                        <span class="top-icon top-icon-user"></span>
                        <span class="hide-for-xs">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('cart')); ?>" title="My Cart">
                        <span class="top-icon top-icon-cart"></span>
                        <span class="hide-for-xs">My Cart</span>
                      </a>
                    </li>
                    <?php if($isAdmin): ?>
                    <li>
                      <a href="<?php echo e(url('admin')); ?>" title="Admin">
                        <span class="top-icon top-icon-check"></span>
                        <span class="hide-for-xs">Admin Dashboard</span>
                      </a>
                    </li>
                    <?php endif; ?>
                  </ul>
                  <?php endif; ?>
                </div>
                <div class="header-top-right">
                  <div class="header-top-dropdowns pull-right">
                    <div class="btn-group dropdown-money">
                      <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                        <span class="hide-for-xs">US Dollar</span>
                        <span class="hide-for-lg">$</span>
                      </button>
                      <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                          <a href="#">
                            <span class="hide-for-xs">Euro</span>
                            <span class="hide-for-lg">&euro;</span>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span class="hide-for-xs">Pound</span>
                            <span class="hide-for-lg">&pound;</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="btn-group dropdown-language">
                      <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                        <span class="flag-container">
                          <img src="images/england-flag.png" alt="flag of england">
                        </span>
                        <span class="hide-for-xs">English</span>
                      </button>
                      <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                          <a href="#">
                            <span class="flag-container">
                              <img src="images/italy-flag.png" alt="flag of england">
                            </span>
                            <span class="hide-for-xs">Italian</span>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span class="flag-container">
                              <img src="images/spain-flag.png" alt="flag of italy">
                            </span>
                            <span class="hide-for-xs">Spanish</span>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span class="flag-container">
                              <img src="images/france-flag.png" alt="flag of france">
                            </span>
                            <span class="hide-for-xs">French</span>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span class="sm-separator">
                              <img src="images/germany-flag.png" alt="flag of germany">
                            </span>
                            <span class="hide-for-xs">German</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="header-text-container pull-right">
                    <p class="header-text">Welcome to Venedor!</p>
                    <?php if(!$isLoggedIn): ?>
                    <p class="header-link">
                      <a href="<?php echo e(url('login')); ?>">login</a>&nbsp;or&nbsp; <a href="<?php echo e(url('signup')); ?>">create an account</a>
                    </p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="inner-header">
          <div class="container">
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 logo-container">
                <h1 class="logo clearfix">
                  <a href="<?php echo e(url('/')); ?>" title="Charlon Shop">
                    <img src="images/favicon.png" alt="Charlon Shop" width="80" height="80">
                  </a>
                  Charlon Shop
                </h1>
              </div>
              <div class="col-md-7 col-sm-7 col-xs-12 header-inner-right">
                <div class="header-box contact-infos pull-right">
                  <ul>
                    <li>
                      <span class="header-box-icon header-box-icon-email"></span>
                      <a href="#">
                        <span class="__cf_email__">[email&#160;protected]</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="header-box contact-phones pull-right clearfix">
                  <span class="header-box-icon header-box-icon-earphones"></span>
                  <ul class="pull-left">
                    <li>+(404) 851 21 48 15</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div id="main-nav-container">
            <div class="container">
              <div class="row">
                <div class="col-md-12 clearfix">
                  <nav id="main-nav">
                    <div id="responsive-nav">
                      <div id="responsive-nav-button">Menu <span id="responsive-nav-button-icon"></span>
                      </div>
                    </div>
                    <ul class="menu clearfix">
                      <li> <a href="<?php echo e(url('/')); ?>">HOME</a> </li>
                      <li> <a href="<?php echo e(url('shop')); ?>">shop</a> </li>
                      <li> <a href="<?php echo e(url('categories')); ?>">categories</a> </li>
                      <li> <a href="<?php echo e(url('about')); ?>">about</a> </li>
                      <li> <a href="<?php echo e(url('contact')); ?>">Contact Us</a>  </li>
                    </ul>
                  </nav>
                  <div id="quick-access">
                    <div class="dropdown-cart-menu-container pull-right">
                      <div class="btn-group dropdown-cart">
                        <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                          <span class="cart-menu-icon"></span> 0 item(s) <span class="drop-price">- $0.00</span>
                        </button>
                        <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                          <p class="dropdown-cart-description">Recently added item(s).</p>
                          <ul class="dropdown-cart-product-list">
                            <li class="item clearfix">
                              <a href="#" title="Delete item" class="delete-item">
                                <i class="fa fa-times"></i>
                              </a>
                              <a href="#" title="Edit item" class="edit-item">
                                <i class="fa fa-pencil"></i>
                              </a>
                              <figure>
                                <a href="product.html">
                                  <img src="images/products/thumbnails/item12.jpg" alt="phone 4">
                                </a>
                              </figure>
                              <div class="dropdown-cart-details">
                                <p class="item-name">
                                  <a href="product.html">Cam Optia AF Webcam</a>
                                </p>
                                <p>1x <span class="item-price">$499</span>
                                </p>
                              </div>
                            </li>
                            <li class="item clearfix">
                              <a href="#" title="Delete item" class="delete-item">
                                <i class="fa fa-times"></i>
                              </a>
                              <a href="#" title="Edit item" class="edit-item">
                                <i class="fa fa-pencil"></i>
                              </a>
                              <figure>
                                <a href="product.html">
                                  <img src="images/products/thumbnails/item13.jpg" alt="phone 2">
                                </a>
                              </figure>
                              <div class="dropdown-cart-details">
                                <p class="item-name">
                                  <a href="product.html">Iphone Case Cover Original</a>
                                </p>
                                <p>1x <span class="item-price">$499 <span class="sub-price">.99</span>
                                  </span>
                                </p>
                              </div>
                            </li>
                          </ul>
                          <ul class="dropdown-cart-total">
                            <li>
                              <span class="dropdown-cart-total-title">Shipping:</span>$7
                            </li>
                            <li>
                              <span class="dropdown-cart-total-title">Total:</span>$1005 <span class="sub-price">.99</span>
                            </li>
                          </ul>
                          <div class="dropdown-cart-action">
                            <p>
                              <a href="<?php echo e(url('cart')); ?>" class="btn btn-custom-2 btn-block">Cart</a>
                            </p>
                            <p>
                              <a href="<?php echo e(url('checkout')); ?>" class="btn btn-custom btn-block">Checkout</a>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <form class="form-inline quick-search-form" role="form" action="#">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search here">
                      </div>
                      <button type="submit" id="quick-search" class="btn btn-custom"></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <section id="content" class="">
        <div class="lg-margin"></div>
        <?php echo $__env->yieldContent('content'); ?>
      </section>

      <footer id="footer">
        <div id="footer-top">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12 widget">
                <div class="title-bg">
                  <h3>Popular</h3>
                </div>
                <div class="footer-popular-slider flexslider footerslider">
                  <ul class="slides">
                    <li>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item1.jpg" alt="item1">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Suiting Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$40</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item2.jpg" alt="item2">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Gap Graphic Cuffed</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="100"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$18.5</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item3.jpg" alt="item3">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Women's Lauren Dress</a>
                        </p>
                        <div class="item-price-special">$30</div>
                      </div>
                    </li>
                    <li>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item4.jpg" alt="item4">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Lauren Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$40</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item5.jpg" alt="item5">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Suiting Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="100"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$18.5</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item6.jpg" alt="item6">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Women's Spahyr Dress</a>
                        </p>
                        <div class="item-price-special">$30</div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="md-margin visible-xs"></div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12 widget">
                <div class="title-bg">
                  <h3>Featured</h3>
                </div>
                <div class="footer-featured-slider flexslider footerslider">
                  <ul class="slides">
                    <li>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item4.jpg" alt="item4">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Suiting Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$40</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item5.jpg" alt="item5">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Gap Graphic Cuffed</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="100"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$18.5</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item6.jpg" alt="item6">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Women's Lauren Dress</a>
                        </p>
                        <div class="item-price-special">$30</div>
                      </div>
                    </li>
                    <li>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item7.jpg" alt="item7">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Lauren Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$40</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item8.jpg" alt="item8">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Suiting Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="100"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$18.5</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item9.jpg" alt="item9">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Women's Spahyr Dress</a>
                        </p>
                        <div class="item-price-special">$30</div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="md-margin visible-xs"></div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12 widget">
                <div class="title-bg">
                  <h3>Specials</h3>
                </div>
                <div class="footer-specials-slider flexslider footerslider">
                  <ul class="slides">
                    <li>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item7.jpg" alt="item7">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Suiting Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$40</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item8.jpg" alt="item8">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Gap Graphic Cuffed</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="100"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$18.5</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item9.jpg" alt="item9">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Women's Lauren Dress</a>
                        </p>
                        <div class="item-price-special">$30</div>
                      </div>
                    </li>
                    <li>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item1.jpg" alt="item1">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Lauren Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$40</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item2.jpg" alt="item2">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Jacket Suiting Blazer</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="100"></div>
                          </div>
                        </div>
                        <div class="item-price-special">$18.5</div>
                      </div>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="product.html">
                            <img src="images/products/thumbnails/item3.jpg" alt="item3">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="product.html">Women's Spahyr Dress</a>
                        </p>
                        <div class="item-price-special">$30</div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="inner-footer">
          <div class="container">
            <div class="row">
              <div class="col-md-3 col-sm-4 col-xs-12 widget">
                <h3>MY ACCOUNT</h3>
                <ul class="links">
                  <li>
                    <a href="#">My account</a>
                  </li>
                  <li>
                    <a href="#">Personal information</a>
                  </li>
                  <li>
                    <a href="#">Addresses</a>
                  </li>
                  <li>
                    <a href="#">Discount</a>
                  </li>
                  <li>
                    <a href="#">Order History</a>
                  </li>
                  <li>
                    <a href="#">Your Vouchers</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-12 widget">
                <h3>INFORMATION</h3>
                <ul class="links">
                  <li>
                    <a href="#">New products</a>
                  </li>
                  <li>
                    <a href="#">Top sellers</a>
                  </li>
                  <li>
                    <a href="#">Specials</a>
                  </li>
                  <li>
                    <a href="#">Manufacturers</a>
                  </li>
                  <li>
                    <a href="#">Suppliers</a>
                  </li>
                  <li>
                    <a href="#">Our stores</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-12 widget">
                <h3>MY ACCOUNT</h3>
                <ul class="contact-list">
                  <li>
                    <strong>Venedor Ltd</strong>
                  </li>
                  <li>United Kingdom</li>
                  <li>Greater London</li>
                  <li>London 02587</li>
                  <li>Oxford Street 48/188</li>
                  <li>Working Days: Mon. - Sun.</li>
                  <li>Working Hours: 9.00AM - 8.00PM</li>
                </ul>
              </div>
              <div class="clearfix visible-sm"></div>
              <div class="col-md-3 col-sm-12 col-xs-12 widget">
                <h3>FACEBOOK LIKE BOX</h3>
                <div class="facebook-likebox">
                  <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fenvato&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="footer-bottom">
          <div class="container">
            <div class="row">
              <div class="col-md-7 col-sm-7 col-xs-12 footer-social-links-container">
                <ul class="social-links clearfix">
                  <li>
                    <a href="#" class="social-icon icon-facebook"></a>
                  </li>
                  <li>
                    <a href="#" class="social-icon icon-twitter"></a>
                  </li>
                  <li>
                    <a href="#" class="social-icon icon-rss"></a>
                  </li>
                  <li>
                    <a href="#" class="social-icon icon-delicious"></a>
                  </li>
                  <li>
                    <a href="#" class="social-icon icon-linkedin"></a>
                  </li>
                  <li>
                    <a href="#" class="social-icon icon-flickr"></a>
                  </li>
                  <li>
                    <a href="#" class="social-icon icon-skype"></a>
                  </li>
                  <li>
                    <a href="#" class="social-icon icon-email"></a>
                  </li>
                </ul>
              </div>
              <div class="col-md-5 col-sm-5 col-xs-12 footer-text-container">
                <p>&copy; <?php echo e(date('Y')); ?> Powered by Charlon Shop&trade;. All Rights Reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </footer>
</div>

<a href="#" id="scroll-top" title="Scroll to Top">
      <i class="fa fa-angle-up"></i>
    </a>
   
 <!-- JS here -->
 <script src="js/jquery.js"></script>
   <script src="js/bootstrap.min.js"></script> 
   <script src="js/smoothscroll.js"></script>
    <script src="js/jquery.debouncedresize.js"></script>
    <script src="js/retina.min.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/jquery.hoverIntent.min.js"></script>
    <script src="js/twitter/jquery.tweet.min.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jflickrfeed.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/colpick.js"></script>
   <script src="js/main.js"></script>
   <script src="js/helpers.js?ver=<?php echo e(rand(999, 9999999)); ?>"></script>
   <script src="lib/sweet-alert/sweetalert2.js"></script>
   <?php echo $__env->yieldContent('scripts'); ?>

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

                 <?php if($pop != "" && $val != ""): ?>
                   <?php echo $__env->make('session-status', ['pop' => $pop, 'val' => $val], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                 <?php endif; ?>


<!--------- Plugins: DO NOT EDIT ------>
<?php
    foreach ($plugins as $p) {
?>
<?php echo $p['value']; ?>

<?php
    }
?>
<!------------------------------------->




  
</body>

</html><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/layout.blade.php ENDPATH**/ ?>