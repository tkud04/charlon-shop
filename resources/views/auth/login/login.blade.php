<?php
$void = 'javascript:void(0)';
$title = "Login or Create an Account";
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
'title' => $title,
'description' => "Login or create an account"
])
<!-- Login -->
<div class="container mt-4">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
               <h2>New Customer</h2>
               <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
               <div class="md-margin"></div><a href="{{url('signup')}}" class="btn btn-custom-2">Create An Account</a>
               <div class="lg-margin"></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <h2>Registered Customers</h2>
               <p>If you have an account with us, please log in.</p>
               <div class="xs-margin"></div>
               <form id="login-form" method="get" action="#">
                  <div class="input-group">
                     <span class="input-group-addon">
                        <span class="input-icon input-icon-email"></span>
                        <span class="input-text">Email*</span>
                     </span> 
                     <input type="text" required="" class="form-control input-lg" id="u" placeholder="Your Email">
                     @include('components.form-validation',['id' => 'u'])
                  </div>
                  <div class="input-group xs-margin">
                     <span class="input-group-addon">
                        <span class="input-icon input-icon-password"></span>
                        <span class="input-text">Password*</span>
                     </span> 
                     <input type="password" required="" class="form-control input-lg" id="p" placeholder="Your Password">
                  </div>
                  @include('components.form-validation',['id' => 'p'])
                  <span class="help-block text-right"><a href="{{url('forgot-password')}}">Forgot your password?</a></span>
                   @include('components.button',['id' => 'login','title' => "Submit"])
                   @include('components.form-loading',['id' => 'login'])
               </form>
               <div class="sm-margin"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Login END -->
@stop

@section('scripts')
<script>
   $(() => {
      hideFormValidations();

      $('#login-btn').click(e => {
         e.preventDefault();
         hideFormValidations();

         const u = $('#u').val(),
            p = $('#p').val(),
            r = $('#login-remember').is(':checked');
         console.log({
            u,
            p,
            r
         });
         const v = u.length < 1 || p.length < 1;

         if (v) {
            if (u.length < 1) $('#u-validation').fadeIn();
            if (p.length < 1) $('#p-validation').fadeIn();
         } else {
            toggleFormButton({
               id: 'login',
               mode: 'hide'
            });

            login({
                  u,
                  p,
                  r
               },
               (data) => {
                  toggleFormButton({
                     id: 'login',
                     mode: 'show'
                  });

                  if (data.status === 'ok') {
                     window.location = '/'; //data.data;
                  } else if (data.status === 'error') {
                     handleResponseError(data);
                  }
               },
               (err) => {
                  toggleFormButton({
                     id: 'login',
                     mode: 'show'
                  });
                  alert(`Failed to log in: ${err}`)
               }
            );
         }

      });
   });
</script>
@stop