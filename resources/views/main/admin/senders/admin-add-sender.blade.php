<?php
$void = 'javascript:void(0)';
$title = "Add Sender";
$mode = "admin";
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
   'title' => "Add Sender",
   'description' => "Here you can upload all required information on new SMTP settings"
  ])

  <div class=" tp-portfolio-area pb-10">
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
       <!-- Start form -->
        <div class="card my-4" style="width: 90%;">
           <div class="card-body">
              <h5 class="card-title">Add New SMTP Setting</h5>
              <div class="alert alert-warning" role="alert"><b>Please be careful with this</b>: Adding invalid settings could cause perfomance issues when sending site emails!</div>
              
              <!--  Form Start -->
              <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <h4 >Server</h4>
                                         <input type="text" class="form-control" id="ss" placeholder="Server" required="">
                                         @include('components.form-validation',['id' => 'ss'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 >Port</h4>
                                     <input type="text" class="form-control" id="sp" placeholder="Port" required="">
                                         @include('components.form-validation',['id' => 'sp'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 >Security</h4>
                                         <input type="text" class="form-control" id="sec" placeholder="Security" value="tls" required="" disabled>
                                         @include('components.form-validation',['id' => 'sec'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 >Requires Authentication?</h4>
                                         <input type="text" class="form-control" id="sa" placeholder="Auth?" value="yes" required="" disabled>
                                         @include('components.form-validation',['id' => 'sa'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 >Username</h4>
                                         <input type="text" class="form-control" id="su" placeholder="Username" required="">
                                         @include('components.form-validation',['id' => 'su'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 >Password</h4>
                                         <input type="password" class="form-control" id="spp" placeholder="Password" required="">
                                         @include('components.form-validation',['id' => 'spp'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 >Sender name</h4>
                                         <input type="text" class="form-control" id="sn" placeholder="Sender name" required="">
                                         @include('components.form-validation',['id' => 'sn'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                     <h4 >Sender email</h4>
                                         <input type="text" class="form-control" id="se" placeholder="Sender email" required="">
                                         @include('components.form-validation',['id' => 'se'])
                                     </div>
                                     
             
                                     <div class="col-lg-12">
                                         <div class="contact-form-btn">
                                         @include('components.button',['id' => 'add-sender'])
                                         </div>
                                         @include('components.form-loading',['id' => 'add-sender'])
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

        const confirmAddSender = (payload = {
                ss,
                sp,
                sec,
                sa,
                su,
                spp,
                sn,
                se
             }) => {
                addSender(
                payload,
                (data) => {
                   toggleFormButton({id: 'add-sender',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Sender added!');
                      window.location = 'senders';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-sender',mode: 'show'});
                    alert(`Failed to add sender: ${err}`);
                }
            );
        }

        $('#add-sender-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const ss = $('#ss').val(), sp = $('#sp').val(), sec = $('#sec').val(),
             sa = $('#sa').val(), su = $('#su').val(), spp = $('#spp').val(),
             sn = $('#sn').val(), se = $('#se').val();
           
            const v = ss.length < 1 || sp.length < 1 || sec.length < 1
                     || sa.length < 1|| su.length < 1 || spp.length < 1
                     || sn.length < 1|| se.length < 1;

            if(v){
              if(ss.length < 1) $('#ss-validation').fadeIn();
              if(sp.length < 1) $('#sp-validation').fadeIn();
              if(sec.length < 1) $('#sec-validation').fadeIn();
              if(sa.length < 1) $('#sa-validation').fadeIn();
              if(su.length < 1) $('#su-validation').fadeIn();
              if(spp.length < 1) $('#spp-validation').fadeIn();
              if(sn.length < 1) $('#sn-validation').fadeIn();
              if(se.length < 1) $('#se-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'add-sender',mode: 'hide'});
             const payload = {
                ss,
                sp,
                sec,
                sa,
                su,
                spp,
                sn,
                se
             };
            
             confirmAddSender(payload);
           
            }
            
        });
    });
 </script>
@stop