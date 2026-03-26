<?php
$p = (isset($popular) && count($popular) > 0) ? $popular : [];
$s = (isset($specials) && count($specials) > 0) ? $specials : [];
$f = (isset($featured) && count($featured) > 0) ? $featured : [];
$sc = 0;
?>

<div class="container">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12 widget">
                <div class="title-bg">
                  <h3>Popular</h3>
                </div>
                <div class="footer-popular-slider flexslider footerslider">
                  <ul class="slides">
                    <li>
                      <?php
                       foreach($p as $item)
                       {
                        $vu = url('view-product')."?xf=".$item['slug'];
                        $images = $item['images']; $img = count($images) > 0 ? $images[0]['url'] : '';
                      ?>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="{{$vu}}">
                            <img src="{{$img}}" alt="{{$item['title']}}">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="{{$vu}}">{{$item['title']}}</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">${{number_format($item['price'],2)}}</div>
                      </div>
                      <?php
                       }
                       shuffle($p);
                      ?>
                    </li>
                    <li>
                      <?php
                       foreach($p as $item)
                       {
                        $vu = url('view-product')."?xf=".$item['slug'];
                        $images = $item['images']; $img = count($images) > 0 ? $images[0]['url'] : '';
                      ?>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="{{$vu}}">
                            <img src="{{$img}}" alt="{{$item['title']}}">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="{{$vu}}">{{$item['title']}}</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">${{number_format($item['price'],2)}}</div>
                      </div>
                      <?php
                       }
                      ?>
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
                      <?php
                       foreach($f as $item)
                       {
                        $vu = url('view-product')."?xf=".$item['slug'];
                        $images = $item['images']; $img = count($images) > 0 ? $images[0]['url'] : '';
                      ?>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="{{$vu}}">
                            <img src="{{$img}}" alt="{{$item['title']}}">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="{{$vu}}">{{$item['title']}}</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">${{number_format($item['price'],2)}}</div>
                      </div>
                      <?php
                       }
                       shuffle($f);
                      ?>
                    </li>
                    <li>
                      <?php
                       foreach($f as $item)
                       {
                        $vu = url('view-product')."?xf=".$item['slug'];
                        $images = $item['images']; $img = count($images) > 0 ? $images[0]['url'] : '';
                      ?>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="{{$vu}}">
                            <img src="{{$img}}" alt="{{$item['title']}}">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="{{$vu}}">{{$item['title']}}</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">${{number_format($item['price'],2)}}</div>
                      </div>
                      <?php
                       }
                      ?>
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
                      <?php
                       foreach($s as $item)
                       {
                        $vu = url('view-product')."?xf=".$item['slug'];
                        $images = $item['images']; $img = count($images) > 0 ? $images[0]['url'] : '';
                      ?>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="{{$vu}}">
                            <img src="{{$img}}" alt="{{$item['title']}}">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="{{$vu}}">{{$item['title']}}</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">${{number_format($item['price'],2)}}</div>
                      </div>
                      <?php
                       }
                       shuffle($s);
                      ?>
                    </li>
                    <li>
                      <?php
                       foreach($s as $item)
                       {
                        $vu = url('view-product')."?xf=".$item['slug'];
                        $images = $item['images']; $img = count($images) > 0 ? $images[0]['url'] : '';
                      ?>
                      <div class="slide-item clearfix">
                        <figure class="item-image-container">
                          <a href="{{$vu}}">
                            <img src="{{$img}}" alt="{{$item['title']}}">
                          </a>
                        </figure>
                        <p class="item-name">
                          <a href="{{$vu}}">{{$item['title']}}</a>
                        </p>
                        <div class="ratings-container">
                          <div class="ratings">
                            <div class="ratings-result" data-result="80"></div>
                          </div>
                        </div>
                        <div class="item-price-special">${{number_format($item['price'],2)}}</div>
                      </div>
                      <?php
                       }
                      ?>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>