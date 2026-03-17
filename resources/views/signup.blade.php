<?php
$void = 'javascript:void(0)';
$title = 'Complete Your Registration';
?>
@extends('layout')

@section('title',$title)

@section('content')

  <!-- Sign Up -->
  <div class="container-fluid">
                  <div class="row justify-content-center">
                     <div class="col-xl-6 col-lg-8">
                        <div class="tp-login-wrapper">
                           <div class="tp-login-top text-center mb-30">
                              <h3 class="tp-login-title">Create account to access Sender 26.</h3>
                              <p>Already have an account? <span><a href="{{url('login')}}">Sign in</a></span></p>
                           </div>
                           <div class="tp-login-option">

                              <div class="tp-login-mail text-center mb-40">
                                 <p>Please fill the form below</p>
                              </div>
                              <div class="tp-login-input-wrapper">
                                  <!--  Form Start -->
             <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-6 mb-4">
                                    <label for="u" class="form-label">Preferred username</label>
                                         <input type="text" class="form-control" id="u" placeholder="johndoe" required="">
                                         @include('components.form-validation',['id' => 'u'])
                                     </div>
                                     <div class="form-group col-6 mb-4">
                                    <label for="e" class="form-label">Email address</label>
                                         <input type="text" class="form-control" id="e" placeholder="johndoe@yahoo.com" required="">
                                         @include('components.form-validation',['id' => 'e'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <label for="p" class="form-label">Password</label>
                                     <input type="password" class="form-control" id="p" placeholder="Password" required="">
                                         @include('components.form-validation',['id' => 'p'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <label for="p2" class="form-label">Confirm Password</label>
                                     <input type="password" class="form-control" id="p2" placeholder="Confirm Password" required="">
                                         @include('components.form-validation',['id' => 'p2'])
                                     </div>
                                     
             
                                     <div class="col-lg-12 p-2">
                                         <div class="contact-form-btn">
                                         @include('components.button',['id' => 'signup'])
                                         </div>
                                         @include('components.form-loading',['id' => 'signup'])
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
  <!-- Sign Up END -->
@stop

@section('scripts')
 <script>
   const months = JSON.parse('{!! json_encode($months) !!}');
   console.log('months: ',months);

    $(() => {
        hideFormValidations();

        $('#month').change(() => {
           //e.preventDefault();
           const m = $('#month').val();
           let temp = months.find(i => i.value === m);
           let ret = '';
           
           if(temp){
              for(let i = 1; i, i < temp.days + 1; i++){
                let dd = i < 10 ? `0${i}` : i;
                ret += `<option value="${i}">${dd}</option>`;
              }
           }
           $('#day').html(ret);
        });

        $('#signup-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const /*fname = $('#fname').val(), lname = $('#lname').val(), */ email = $('#e').val(), username = $('#u').val(),
           /* gender = $('#gender').val(), month = $('#month').val(), day = $('#day').val(), phone = $('#phone').val(),*/
            pass = $('#p').val(), pass2 = $('#p2').val();// tag = $('#username').val();
           
            const v = /*fname.length < 1 || lname.length < 1 || */email.length < 1 || username.length < 1 ||
                      /*gender === 'none' || month === 'none' || day === 'none' || phone.length < 1 ||*/
                      pass.length < 6 || pass2 != pass;// || tag.length < 1;

            if(v){
              //if(fname.length < 1) $('#fname-validation').fadeIn();
              //if(lname.length < 1) $('#lname-validation').fadeIn();
              if(email.length < 6) $('#e-validation').fadeIn();
              if(username.length < 6) $('#u-validation').fadeIn();
              //if(phone.length < 6) $('#phone-validation').fadeIn();
             // if(month === 'none') $('#month-validation').fadeIn();
             // if(day === 'none') $('#day-validation').fadeIn();
              if(pass.length < 6) $('#p-validation').fadeIn();
              if(pass2 !== pass) $('#p2-validation').fadeIn();
             // if(tag.length < 1) $('#tag-validation').fadeIn();
            //  if(gender === 'none') $('#gender-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'signup',mode: 'hide'});
             const payload = {
                //f: fname,
                //l: lname,
                e: email,
                //ph: phone,
                p: pass,
                p2: pass2,
                t: username,
                //g: gender,
                //t: tag,
               // d: day,
               // m: month,
                //t2: "{$existingRequest['code']}"
             };

            signup(
                payload,
                (data) => {
                   toggleFormButton({id: 'signup',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Registration complete!');
                      window.location = 'login';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'signup',mode: 'show'});
                    alert(`Failed to sign up: ${err}`)
                }
            );
            }
            
        });
    });
 </script>
@stop