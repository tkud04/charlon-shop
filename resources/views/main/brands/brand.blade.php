<?php
$void = 'javascript:void(0)';
$title = $bra['title'];
?>
@extends('layout')

@section('title',$title)


@section('content')
<?php
$slug = $bra['slug'];
$bu = url('brand')."?xf=".$slug;
$img = $bra['img'] ? $bra['img'] : "images/unkwown.png";
?>

@include('components.category-header',[
    'img' => $img,
    'title' => $title,
    'description' => 'View all available products for this brand'
    ])
<div class="container">
   <div class="row mt-4">
        <div class="col-md-12">
           <div class="row">
           <div class="col-md-9 col-sm-8 col-xs-12 main-content">
               @include('components.pagination2',[
                  'page' => $page,
                  'totalpages' => $totalPages,
                  'url' => $bu
                ])
               <div></div>
               <div class="category-item-container">
               <div class="row">
                  <?php
                    $v = isset($products) && count($products) > 0;

                    if($v)
                    {
                     foreach($products as $p)
                     {
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
               <div class="pagination-container clearfix">
              <div class="pull-right">
                @include('components.pagination2',[
                  'page' => $page,
                  'totalpages' => $totalPages,
                  'url' => $bu
                ])
              </div>
            </div>
           </div>
           <aside class="col-md-3 col-sm-4 col-xs-12 mt-4 sidebar">
               @include('components.category-sidebar',[
                 'data' => $categories
                ])
           </aside>
           </div>
        </div>
   </div>
</div>
@stop