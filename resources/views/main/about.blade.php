<?php
$void = 'javascript:void(0)';
$title = "About Us";
$userMode = "dashboard";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<style>
    .about-circle{
        width: 400px;
        height: 400px;
    }
</style>
@stop

@section('content')
@include('components.generic-banner',[
   'title' => $title,
   'description' => "Brief overview of who we are and our core values"
  ])



@stop