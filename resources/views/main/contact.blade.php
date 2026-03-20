<?php
$void = 'javascript:void(0)';
$title = "Contact Us";
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
   'title' => $title,
   'description' => "Reach out to us on social media or send us a message"
  ])
@stop