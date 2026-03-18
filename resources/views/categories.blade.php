<?php
$void = 'javascript:void(0)';
$title = "Categories";
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
'title' => $title,
'description' => "View all available product categories"
])
<div class="container">
<div class="row portfolio-item-container" data-maxcolumn="3" data-layoutmode="fitRows">
    <?php
     $v = isset($categories) && count($categories) > 0;

     if($v)
     {
        foreach($categories as $c)
        {
           $slug = $c['slug'];
           $vu = url('category')."?xf=".$slug;
           $img = $c['img'] ? $c['img'] : "images/unkwown.png";
    ?>
    <div class="col-md-4 col-sm-4 col-xs-4 portfolio-item photography">
        <figure><img src="{{$img}}" alt="{{$c['title']}}">
            <figcaption>
                <a href="{{$img}}" title="{{$c['title']}}" data-rel="prettyPhoto[portfolio]" class="zoom-button"></a> 
                <a href="{{$vu}}" class="link-button"></a> 
                <a href="#" class="like-button"><i class="fa fa-heart"></i><span>0</span></a>
            </figcaption>
        </figure>
        <h2><a href="{{$vu}}">{{$c['title']}}</a></h2>
        <p><a href="{{$vu}}">10 items</a></p>
    </div>
    <?php
        }
     }
    ?>
</div>
</div>
@stop