<?php
$void = 'javascript:void(0)';
$title = 'Reset Password';
?>
@extends('layout')

@section('title',$title)


@section('content')
  @include('components.generic-banner',['title' => $title])

  <!-- Sign Up -->
  <div class="contact-form dark-section order-lg-1 order-1">
                             
                            <!-- Sign up Form Start -->
                            <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="row">
                                         
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="password"  class="form-control" id="pass" placeholder="Enter new Password" required="">
                                        @include('components.form-validation',['id' => 'pass'])
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="password" class="form-control" id="pass2" placeholder="Confirm new Password" required="">
                                        @include('components.form-validation',['id' => 'pass2'])
                                    </div>
                                    
            
                                    <div class="col-lg-12">
                                        <div class="contact-form-btn">
                                        @include('components.button',['id' => 'reset'])
                                        </div>
                                        @include('components.form-loading',['id' => 'reset'])
                                    </div>
                                </div>
                            </form>
                            <!-- Contact Form End -->
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