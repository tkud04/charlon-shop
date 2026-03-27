<?php
$void = 'javascript:void(0)';
$title = "Welcome";
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.home-slider',[
    'data' => $bxProducts
])
@stop

@section('scripts')
<script>
    const addToCart = (pid) => {
        console.log('slug captured: ',pid);
    }
    $(() => {
      $('#bxCarousel').carousel();
    });
   
</script>
@stop

