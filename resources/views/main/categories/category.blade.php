<?php
$void = 'javascript:void(0)';
$title = $cat['title'];
?>
@extends('layout')

@section('title',$title)


@section('content')
<?php
$slug = $cat['slug'];
$vu = url('category')."?xf=".$slug;
$img = $cat['img'] ? $cat['img'] : "images/unkwown.png";
?>

@include('components.category-header',[
    'img' => $img,
    'title' => $title,
    'description' => 'View all available products for this category'
    ])
<div class="container">
   <div class="row">
        <div class="col-md-12">
           <div class="row">
           <div class="col-md-9 col-sm-8 col-xs-12 main-content">
              
           </div>
           <aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
               @include('components.category-sidebar',[
                 'data' => $categories
                ])
           </aside>
           </div>
        </div>
   </div>
</div>
@stop