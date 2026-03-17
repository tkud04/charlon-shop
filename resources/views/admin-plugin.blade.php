<?php
$void = 'javascript:void(0)';
$title = "View Plugin";
$mode = "admin";
?>
@extends('dashboard_layout')

@section('title',$title)



@section('dashboard-content')

<div class="contact-form dark-section order-lg-1 order-1">
                             
                             <!--  Form Start -->
                             <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                         <input type="text" class="form-control" id="title" placeholder="Title" value="{{$p['name']}}" disabled>

                                     </div>
                                     <div class="form-group col-md-12 mb-4">
                                         <textarea class="form-control" rows="15" id="content" placeholder="Content" disabled>
                                            {!! $p['value'] !!}
                                         </textarea>
                                     </div>
                                     
             
                                 </div>
                             </form>
                             <!--  Form End -->
                         </div>
@stop


