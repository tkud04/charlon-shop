<?php
$void = 'javascript:void(0)';
$title = "Add Plugin";
$mode = "admin";
?>
@extends('layout')

@section('title',$title)

@section('dashboard-styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop


@section('content')
@include('components.generic-banner',[
   'title' => "Add Plugin",
   'description' => "Here you can upload all required information on new site plugins"
  ])

  <div class="container">
<div class="row">
<div class="col-md-4">
     <div class="row">
        <div class="col-md-12 my-4">
           @include('components.admin-sidebar')
        </div>
     </div>
  </div>
  <div class="col-md-8" style="height: 400px; overflow:scroll;">
  <div class="card my-4" style="width: 90%;">
        <div class="card-body">
           <h5 class="card-title">Add New Plugin</h5>
           <div class="alert alert-warning" role="alert"><b>Please be careful with this</b>: Uploading malicious plugins could severely damage the sites featres, expose member information to hackers etc!</div>

           <div class="contact-form dark-section order-lg-1 order-1">
                             
                             <!--  Form Start -->
                             <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                         <h4>Title</h4>
                                         <input type="text" class="form-control" id="title" placeholder="Title" required="">
                                         @include('components.form-validation',['id' => 'title'])
                                     </div>
                                     <div class="form-group col-md-12 mb-4">
                                        <h4>Content</h4>
                                         <textarea class="form-control" rows="15" id="content" placeholder="Content" required=""></textarea>
                                         @include('components.form-validation',['id' => 'content'])
                                     </div>
                                     
             
                                     <div class="col-lg-12">
                                         <div class="contact-form-btn">
                                         @include('components.button',['id' => 'add-plugin'])
                                         </div>
                                         @include('components.form-loading',['id' => 'add-plugin'])
                                     </div>
                                 </div>
                             </form>
                             <!--  Form End -->
                </div>

        </div>
  </div>

  </div>
</div>
  </div>

@stop


@section('scripts')
 <script>
    $(() => {
        hideFormValidations();

      

        $('#add-plugin-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const title = $('#title').val(), content = $('#content').val();
           
            const v = title.length < 1 || content.length < 1;

            if(v){
              if(title.length < 1) $('#title-validation').fadeIn();
              if(content.length < 1) $('#content-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'add-plugin',mode: 'hide'});
             const payload = {
                n: title,
                v: content
             };

            addPlugin(
                payload,
                (data) => {
                   toggleFormButton({id: 'add-plugin',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Plugin added!');
                      window.location = 'plugins';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-plugin',mode: 'show'});
                    alert(`Failed to add plugin: ${err}`);
                }
            );
            }
            
        });
    });
 </script>
@stop