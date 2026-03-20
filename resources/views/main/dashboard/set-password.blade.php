<?php
$void = 'javascript:void(0)';
$title = 'Change Password';
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
    'title' => $title,
    'description' => "Change your password"
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
                 
                  @include('components.button',['id' => 'change','title' => "Submit"])
                   @include('components.form-loading',['id' => 'change'])
               </form>
               <div class="sm-margin"></div>
            </div>
     </div>
  </div>

@stop
  <!-- Change Password  END -->


@section('scripts')
 <script>
    $(() => {
        hideFormValidations();

        $('#change-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const  pass = $('#pass').val(), pass2 = $('#pass-2').val();
           
            const v =  pass.length < 6 || pass2 != pass;

            if(v){
              if(pass.length < 6) $('#pass-validation').fadeIn();
              if(pass2 !== pass) $('#pass-2-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'change',mode: 'hide'});
             const payload = {
                p: pass,
                p2: pass2,
             };

            changePassword(
                payload,
                (data) => {
                   toggleFormButton({id: 'change',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Password change successful!');
                      window.location = 'dashboard';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'change',mode: 'show'});
                    alert(`Failed to change password: ${err}`)
                }
            );
            }
            
        });
    });
 </script>
@stop