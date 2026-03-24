<?php
$void = 'javascript:void(0)';
$title = $product['title'];
?>
@extends('layout')

@section('title',$title)

@section('content')

@include('components.generic-banner',[
    'title' => $title,
    'description' => 'View information about this product'
    ])

@stop