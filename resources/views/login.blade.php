<?php
$void = 'javascript:void(0)';
$title = "Login";
?>
@extends('layout')

@section('title',$title)


@section('content')

  <!-- Login -->
               <div class="container-fluid">
                  <div class="row justify-content-center">
                     <div class="col-xl-6 col-lg-8">
                        <div class="tp-login-wrapper">
                           <div class="tp-login-top text-center mb-30">
                              <h3 class="tp-login-title">Login to access Sender 26.</h3>
                              <p>Don't have an account? <span><a href="#">Apply for access from app owner</a></span></p>
                           </div>
                           <div class="tp-login-option">

                              <div class="tp-login-mail text-center mb-40">
                                 <p>Please login to continue</p>
                              </div>
                              <div class="tp-login-input-wrapper">
                                  <!--  Form Start -->
             <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-12 mb-4">
                                    <label for="u" class="form-label">Email address or username</label>
                                         <input type="text" class="form-control" id="u" placeholder="johndoe" required="">
                                         @include('components.form-validation',['id' => 'u'])
                                     </div>
                                     <div class="form-group col-12 mb-4">
                                     <label for="p" class="form-label">Password</label>
                                     <input type="password" class="form-control" id="p" placeholder="Password" required="">
                                         @include('components.form-validation',['id' => 'p'])
                                     </div>
                                     
             
                                     <div class="col-lg-12 p-2">
                                         <div class="contact-form-btn">
                                         @include('components.button',['id' => 'login'])
                                         </div>
                                         @include('components.form-loading',['id' => 'login'])
                                     </div>
                                 </div>
                             </form>
                             <!--  Form End -->
                              </div>
                              <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-between mb-30">
                                 <div class="tp-login-remeber">
                                    <input id="login-remember" type="checkbox">
                                    <label for="login-remember">Remember me</label>
                                 </div>
                                 <div class="tp-login-forgot">
                                    <a href="{{url('forgot-password')}}">Forgot Password?</a>
                                 </div>
                              </div>
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

            const u = $('#u').val(), p = $('#p').val(), r = $('#login-remember').is(':checked');
            console.log({u,p,r});
            const v = u.length < 1 || p.length < 1;

            if(v){
              if(u.length < 1) $('#u-validation').fadeIn();
              if(p.length < 1) $('#p-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'login',mode: 'hide'});

            login(
                {u,p,r},
                (data) => {
                   toggleFormButton({id: 'login',mode: 'show'});

                   if(data.status === 'ok'){
                      window.location = '/';//data.data;
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'login',mode: 'show'});
                    alert(`Failed to log in: ${err}`)
                }
            );
            }
            
        });
    });
 </script>
@stop