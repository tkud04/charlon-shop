<?php
$void = 'javascript:void(0)';
$title = "Forgot Password";
?>
@extends('layout')

@section('title',$title)


@section('content')
  @include('components.generic-banner',['title' => $title])

  <!-- Login -->
  <div class="contact-form dark-section order-lg-1 order-1">
                             
                            <!-- Login Form Start -->
                            <form action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <h3 class="text-white">Email or username</h3>
                                        <input type="text" class="form-control" id="email" placeholder="Email address" required="">
                                        @include('components.form-validation',['id' => 'email'])
                                    </div>
                                 </div>
                                    
            
                                    <div class="col-lg-12">
                                        <div class="contact-form-btn">
                                        @include('components.button',['id' => 'fp'])
                                        </div>
                                       
                                        @include('components.form-loading',['id' => 'fp'])
                                    </div>
                                </div>
                            </form>
                            <!-- Login Form End -->
                        </div>
  <!-- Login END -->
@stop

@section('scripts')
 <script>
    $(() => {
        hideFormValidations();

        $('#fp-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const u = $('#email').val(), v = u.length < 1;

            if(v){
              if(u.length < 1) $('#email-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'fp',mode: 'hide'});

            forgotPassword(
                {u},
                (data) => {
                   toggleFormButton({id: 'fp',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Instructions to reset your password have been sent o your email')
                      window.location = 'login';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'fp',mode: 'show'});
                    alert(`Failed to initiate forgot password: ${err}`)
                }
            );
            }
            
        });
    });
 </script>
@stop