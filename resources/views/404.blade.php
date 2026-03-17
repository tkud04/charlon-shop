<?php
$void = 'javascript:void(0)';
?>
@extends('layout')

@section('title',"Welcome")

@section('content')
 <!-- 404 start -->
<div class="error-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Error Page Image Start -->
                    <div class="error-page-image wow fadeInUp">
                        <img src="images/404-error-img.png" alt="">
                    </div>
                    <!-- Error Page Image End -->
                    
                    <!-- Error Page Content Start -->
                    <div class="error-page-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Oops! page <span>not found</span></h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Error Page Content Body Start -->
                        <div class="error-page-content-body">
                            <p class="wow fadeInUp" data-wow-delay="0.2s">The page you are looking for does not exist.</p>
                            <a class="btn-default wow fadeInUp" data-wow-delay="0.4s" href="./">back to home</a>
                        </div>
                        <!-- Error Page Content Body End -->
                    </div>
                    <!-- Error Page Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- 404 end -->

@stop
