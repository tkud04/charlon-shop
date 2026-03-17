<?php
$void = 'javascript:void(0)';
$title = 'Reset Password';
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
    'title' => $title,
    'description' => "Reset your password"
    ])

  <!-- Sign Up -->
  <div class="container mt-4">

     <div class="row">
     <div class="col-md-12">
               <div class="xs-margin"></div>
               <form id="login-form" method="get" action="#">
                  <div class="row">
                  <div class="col-md-6">
                        <div class="input-group xs-margin">
                            <span class="input-group-addon">
                               <span class="input-icon input-icon-password"></span>
                               <span class="input-text">Password*</span>
                            </span> 
                           <input type="password" required="" class="form-control input-lg" id="pass" placeholder="Your Password">
                          
                        </div>
                         @include('components.form-validation',['id' => 'pass'])
                     </div>
                     <div class="col-md-6">
                        <div class="input-group xs-margin">
                            <span class="input-group-addon">
                               <span class="input-icon input-icon-password"></span>
                               <span class="input-text">Confirm Password*</span>
                            </span> 
                           <input type="password" required="" class="form-control input-lg" id="pass2" placeholder="Confirm Password">
                          
                        </div>
                        @include('components.form-validation',['id' => 'pass2'])
                     </div>
                  </div>
                 
                  @include('components.button',['id' => 'reset','title' => "Submit"])
                   @include('components.form-loading',['id' => 'reset'])
               </form>
               <div class="sm-margin"></div>
            </div>
     </div>
  </div>
  <!-- Login END -->
@stop

@section('scripts')
 <script>
    $(() => {
        hideFormValidations();

        $('#reset-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const pass = $('#pass').val(), pass2 = $('#pass2').val();
        
            const v =  pass.length < 6 || pass2 != pass;

            if(v){
              if(pass.length < 6) $('#pass-validation').fadeIn();
              if(pass2 !== pass1) $('#pass2-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'reset',mode: 'hide'});
             const payload = {
                p: pass,
                p2: pass2,
                x: '{{$xf}}'
             };

            reset(
                payload,
                (data) => {
                   toggleFormButton({id: 'reset',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Password reset successful!');
                      window.location = 'login';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'reset',mode: 'show'});
                    alert(`Failed to reset password: ${err}`)
                }
            );
            }
            
        });
    });
 </script>
@stop