<?php
$void = 'javascript:void(0)';
$title = "Brands";
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
'title' => $title,
'description' => "View all available product brands"
])
<div class="container">
<div class="row portfolio-item-container" data-maxcolumn="3" data-layoutmode="fitRows">
    <?php
     $v = isset($brands) && count($brands) > 0;

     if($v)
     {
        foreach($brands as $b)
        {
           $slug = $b['slug'];
           $vu = url('brand')."?xf=".$slug;
           $img = $b['img'] ? $b['img'] : "images/unkwown.png";
    ?>
    <div class="col-md-4 col-sm-4 col-xs-4 portfolio-item photography">
        <figure><img src="{{$img}}" alt="{{$b['title']}}">
            <figcaption>
                <a href="{{$img}}" title="{{$b['title']}}" data-rel="prettyPhoto[portfolio]" class="zoom-button"></a> 
                <a href="{{$vu}}" class="link-button"></a> 
                <a href="#" class="like-button"><i class="fa fa-heart"></i><span>0</span></a>
            </figcaption>
        </figure>
        <h2><a href="{{$vu}}">{{$b['title']}}</a></h2>
        <p><a href="{{$vu}}">{{$b['product_count']}} items</a></p>
    </div>
    <?php
        }
     }
    ?>
</div>
</div>
@stop