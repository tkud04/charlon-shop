<?php
$void = 'javascript:void(0)';
$title = "Welcome";
?>
@extends('layout')

@section('title',$title)


@section('content')
  @include('components.widget-header',[
    'title' => "HOT Products",
    'subtitle' => "Best sellers for ".date("M Y")
  ])


@include('components.home-slider',[
    'data' => $bxProducts
])

<div class="lg-margin2x"></div>
@include('components.widget-header',[
    'title' => "HOT Categories",
    'subtitle' => "Best sellers for ".date("M Y")
  ])

  <div class="container"> <!-- Start container  -->
<div class="row">
  <div class="col-md-6">
  <div id="category-carousel" class="carousel" <?php /*data-ride="carousel"*/?> >
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                <?php
                                    for($i = 0; $i < count($categories); $i++)
                                    {
                                      $ss = $i === 0 ? "active" : "";
                                ?>
                                  <li data-target="#category-carousel" data-slide-to="{{$i}}" class="{{$ss}}"></li>
                                <?php
                                    }
                                ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" style="background-color: rgba(0,0,0,0.8);">
                                  <?php
                                    for($i = 0; $i < count($categories); $i++)
                                    {
                                      $cat = $categories[$i];
                                      $img = $cat['img'];
                                      $ct = $cat['title'];
                                      $ss = $i === 0 ? " active" : "";
                                  ?>
                                    <div class="item"{{$ss}}>
                                        <img src="{{$img}}" class="img-responsive" style="width: 100%; height: 300px;" alt="{{$ct}}">
                                        <div style="z-index: 2; display: flex; justify-content: center; align-items: center;">
                                        More Features
                                        </div><!-- End .carousel-caption -->
                                    </div><!-- End .item -->
                                  <?php
                                    }
                                  ?>
                                   
                                </div><!-- End .carousel-inner -->

                                <!-- Controls -->
                                <a class="left carousel-control flex-centre" href="#category-carousel" role="button" data-slide="prev">
                                <i class="fa fa-chevron-left"></i>
                                </a>
                                <a class="right carousel-control flex-centre" href="#category-carousel" role="button" data-slide="next">
                                <i class="fa fa-chevron-right"></i>
                                </a>
                                </div>
  </div>
  <div class="col-md-6" style="margin-top: 15px;">
  <div class="hero-unit">
    <h2>Welcome to Computer City!</h2>
    <p>We're passionate about delivering the very best in technology and electronics at affordable prices. Whether you're shopping for a powerful laptop, a cutting-edge smartphone, an efficient printer, or must-have accessories, we've got exactly what you need.</p>
    <span class="small-bottom-border big"></span>
</div>

  </div>
</div>
<div class="lg-margin2x"></div>
@include('components.widget-header',[
    'title' => "Why Shop With Us",
    'subtitle' => "Your trusted store for Computers & Electronics",
    'style' => "margin-top: 30px;"
  ])

<div class="row" style="margin-top: 15px;">
  <?php
   foreach($points as $p)
   {
  ?>
	<div class="col-md-4 col-sm-4 col-xs-6 service-box-container">
		<div class="services-box">
			<div class="wwd">
        <i class="fa fa-{{$p['icon']}} wwd-icon"></i>
      </div>
			<h3>
				<a href="#">{{$p['title']}}</a>
				<span class="small-bottom-border"></span>
			</h3>
			<p>{!!$p['desc']!!}</p>
		</div>
	</div>
  <?php
   }
  ?>
	
</div>

<div class="lg-margin2x"></div>

@include('components.widget-header',[
    'title' => "Trending Products",
    'subtitle' => "Your trusted store for Computers & Electronics",
  ])

  <div class="category-item-container">
     <div class="row">
     <?php
                    $v = isset($topProducts) && count($topProducts) > 0;
                    

                    if($v)
                    {
                      shuffle($topProducts);
                      $tctr = count($topProducts) >= 6 ? 6 : count($topProducts);
                     for($i = 0; $i < $tctr; $i++)
                     {
                        $p = $topProducts[$i];
                        $pid = $p['slug'];
                        $vu = url('view-product')."?xf=".$pid;
                        $imgs = $p['images']; $img = count($imgs) > 0 ? $imgs[0]['url'] : '';
                        $pname = substr($p['title'],0,50)."...";
                        $formerPrice = $p['formerPrice']; $newPrice = $p['newPrice'];
                  ?>
   <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="item item-hover">
                    <div class="item-image-wrapper">
                      <figure class="item-image-container">
                        <a href="{{$vu}}">
                          <img src="{{$img}}" alt="{{$pname}}" class="item-image">
                          <img src="{{$img}}" alt="{{$pname}}" class="item-image-hover">
                        </a>
                      </figure>
                      <div class="item-price-container">
                        <span class="old-price">${{$formerPrice}}<span class="sub-price">.99</span>
                        </span>
                        <span class="item-price">${{$newPrice}} <span class="sub-price">.99</span>
                        </span>
                      </div>
                     <span class="discount-rect">-15%</span>
                    </div>
                    <div class="item-meta-container">
                      <div class="ratings-container">
                        <div class="ratings">
                          <div class="ratings-result" data-result="80" style="width: 75.2px;"></div>
                        </div>
                        <span class="ratings-amount" style="display: none;">5 Reviews</span>
                      </div>
                      <h3 class="item-name">
                        <a href="{{$vu}}">{{$pname}}</a>
                      </h3>
                      <div class="item-action">
                        <a href="#" class="item-add-btn">
                          <span class="icon-cart-text">Add to Cart</span>
                        </a>
                        <div class="item-action-inner" style="visibility: hidden; overflow: hidden; padding-left: 0px; width: 0px;">
                          <a href="#" class="icon-button icon-like">Favourite</a>
                          <a href="#" class="icon-button icon-compare">Checkout</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
      <?php
                     }
                    }
      ?>
     </div>
  </div>
  </div> <!-- End container -->

  


@stop





@section('scripts')
<script>
    let slideCtr = 0;
    const slideTotal = {{count($bxProducts)}};

    const accc = (pid) => {
        console.log('slug captured: ',pid);
        const cartPayload = {
                    q: 1,
                    xf: pid
                };

                toggleFormButton({id: 'index-cart',mode: 'hide'});
               atc(
            cartPayload,
            (data) => {
                   toggleFormButton({id: 'index-cart',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Added!');
                    window.location = 'cart';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'index-cart',mode: 'show'});
                    alert(`Failed to add to cart: ${err}`);
                }
            );
    }

    const prevSlider = () => {
        const prevItem = slideCtr;
        slideCtr = prevItem - 1;

      if(slideCtr < 0){
        slideCtr = 0;
      }

    
      $(`.cd`).hide();
      $(`.cd-${slideCtr}`).fadeIn();

    }

    const nextSlider = () => {
        const prevItem = slideCtr;
        slideCtr = prevItem + 1;

      if(slideCtr >= slideTotal){
        slideCtr = slideTotal - 1;
      }

      $(`.cd`).hide();
      $(`.cd-${slideCtr}`).fadeIn();

    }

    $(() => {
      hideFormValidations();
      
      //Hide other carousel items
      for(let i = 1; i < {{count($bxProducts)}}; i++) $(`.cd-${i}`).hide();

       $('#category-carousel').carousel({
        interval: 2000
       });
    });

   
</script>
@stop

