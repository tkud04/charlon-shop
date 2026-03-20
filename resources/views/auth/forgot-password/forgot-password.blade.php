<?php
$void = 'javascript:void(0)';
$title = "Forgot Password";
?>
@extends('layout')

@section('title',$title)


@section('content')
  @include('components.generic-banner',[
    'title' => $title,
    'description' => "Confirm your email to reset your password"
    ])

  <!-- Login -->
  <div class="container mt-4">
     <div class="row">
     <div class="col-md-12">
               <div class="xs-margin"></div>
               <form id="login-form" method="get" action="#">
                  <div class="row">
                 
                     <div class="col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-email"></span>
                            <span class="input-text">Email*</span>
                          </span> 
                          <input type="text" required="" class="form-control input-lg" id="u" placeholder="Your Email">
                         
                        </div>
                         @include('components.form-validation',['id' => 'u'])
                     </div>
                    
                    
                  </div>
                 
                  @include('components.button',['id' => 'fp','title' => "Submit"])
                   @include('components.form-loading',['id' => 'fp'])
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

        $('#fp-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const u = $('#u').val(), v = u.length < 1;

            if(v){
              if(u.length < 1) $('#u-validation').fadeIn();
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