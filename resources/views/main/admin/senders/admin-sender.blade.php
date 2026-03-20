<?php
$void = 'javascript:void(0)';
$title = "View Sender";
$mode = "admin";
?>
@extends('dashboard_layout')

@section('title',$title)

@section('dashboard-styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop


@section('dashboard-content')

<div class="contact-form dark-section order-lg-1 order-1">
                             
                             <!--  Form Start -->
                             <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <h4 class="text-white">Server</h4>
                                         <input type="text" class="form-control" id="ss" placeholder="Server" value="{{$s['ss']}}" disabled>
                                         @include('components.form-validation',['id' => 'ss'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 class="text-white">Port</h4>
                                     <input type="text" class="form-control" id="sp" placeholder="Port" value="{{$s['sp']}}" disabled>
                                         @include('components.form-validation',['id' => 'sp'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 class="text-white">Security</h4>
                                         <input type="text" class="form-control" id="sec" placeholder="Security" value="tls" disabled>
                                         @include('components.form-validation',['id' => 'sec'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 class="text-white">Requires Authentication?</h4>
                                         <input type="text" class="form-control" id="sa" placeholder="Auth?" value="yes" disabled>
                                         @include('components.form-validation',['id' => 'sa'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 class="text-white">Username</h4>
                                         <input type="text" class="form-control" id="su" placeholder="Username" value="{{$s['su']}}" disabled>
                                         @include('components.form-validation',['id' => 'su'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 class="text-white">Password</h4>
                                         <input type="password" class="form-control" id="spp" placeholder="Password" value="{{$s['spp']}}" disabled>
                                         @include('components.form-validation',['id' => 'spp'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 class="text-white">Sender name</h4>
                                         <input type="text" class="form-control" id="sn" placeholder="Sender name" value="{{$s['sn']}}" disabled>
                                         @include('components.form-validation',['id' => 'sn'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 class="text-white">Sender email</h4>
                                         <input type="text" class="form-control" id="se" placeholder="Sender email" value="{{$s['se']}}" disabled>
                                         @include('components.form-validation',['id' => 'se'])
                                     </div>
                                     
             
                                 </div>
                             </form>
                             <!--  Form End -->
                         </div>
@stop


@section('dashboard-scripts')
 <script>
    $(() => {
        hideFormValidations();
      
    });
 </script>
@stop