<?php
$void = 'javascript:void(0)';
$title = "Add Ad";
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
                                         <input type="text" class="form-control" id="title" placeholder="Title" required="">
                                         @include('components.form-validation',['id' => 'title'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <input type="text" class="form-control" id="content" placeholder="URL" required="">
                                         @include('components.form-validation',['id' => 'content'])
                                     </div>
                                     <div class="form-group col-md-12 mb-4">
                                     <input type="text" class="form-control" id="image" placeholder="Image URL" required="">
                                         @include('components.form-validation',['id' => 'image'])
                                     </div>
                                     
             
                                     <div class="col-lg-12">
                                         <div class="contact-form-btn">
                                         @include('components.button',['id' => 'add-ad'])
                                         </div>
                                         @include('components.form-loading',['id' => 'add-ad'])
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

      

        $('#add-ad-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const title = $('#title').val(), image = $('#image').val(), content = $('#content').val();
           
            const v = title.length < 1 || image.length < 1 || content.length < 1;

            if(v){
              if(title.length < 1) $('#title-validation').fadeIn();
              if(image.length < 1) $('#image-validation').fadeIn();
              if(content.length < 1) $('#content-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'add-ad',mode: 'hide'});
             const payload = {
                n: title,
                v: content,
                i: image
             };

            addAd(
                payload,
                (data) => {
                   toggleFormButton({id: 'add-ad',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Ad added!');
                      window.location = 'ads';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-ad',mode: 'show'});
                    alert(`Failed to add ad: ${err}`);
                }
            );
            }
            
        });
    });
 </script>
@stop