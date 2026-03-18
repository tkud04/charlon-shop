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

</div>
@stop