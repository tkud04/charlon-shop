<?php
$void = 'javascript:void(0)';
$title = "Admin Dashboard";
?>
@extends('layout')

@section('title',$title)


@section('styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop


@section('content')

@include('components.generic-banner',[
   'title' => "Admin Dashboard",
   'description' => "Welcome to the Admin Center. Here you can configure the settings for the website. You can also view/manage members information, site setttings, contact info and much more!"
  ])

<!-- Stats start -->
  @include('components.admin-dashboard-stats',[
      'total_members' => count($members),
      'total_events' => count($events),
      'total_requests' => count($member_requests),
    ])                          
<!-- Stats end -->

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
     <h3>Quick Actions</h3>
     <div class="card my-4" style="width: 80%;">
        <div class="card-body">
           <h5 class="card-title">Create Signup Link</h5>
           <div class="alert alert-warning" role="alert"><b>Please note</b>: Do not generate links for members who are not yet to be registered!</div>
           
           <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp my-4" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                    <input type="email" class="form-control" id="cl-xf" placeholder="Email address or username" required="">
                                         @include('components.form-validation',['id' => 'cl-xf'])
                                     </div>
                                     
             
                                     <div class="col-md-6">
                                         <a href="#" id="cl-btn" class="tp-login-btn w-100">Submit</a>
                                         @include('components.form-loading',['id' => 'cl'])
                                     </div>
                                     <div class="col-md-12" id="cl-result"></div>
                                 </div>
                             </form>
       </div> 
     </div>

     <div class="card my-4" style="width: 80%;">
        <div class="card-body">
           <h5 class="card-title">Add Announcement</h5>
           <div class="alert alert-warning" role="alert"><b>Please be careful with this</b>: Announcements will be displayed IMMEDIATELY to all users</div>
           
           <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp my-4" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                    <input type="text" class="form-control" id="aa-title" placeholder="Title or date" required="">
                                         @include('components.form-validation',['id' => 'aa-title'])
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                    <input type="text" class="form-control" id="aa-msg" placeholder="Message" required="">
                                         @include('components.form-validation',['id' => 'aa-msg'])
                                     </div>
                                     
             
                                     <div class="col-md-12">
                                         <a href="#" id="aa-btn" class="tp-login-btn w-100">Submit</a>
                                         @include('components.form-loading',['id' => 'aa'])
                                     </div>
                                 </div>
                             </form>
       </div> 
     </div>

  </div>
</div>
</div>
</div>

@stop

@section('scripts')
<script src="lib/datatables/datatables.min.js"></script>

<script>
  
  $(() => {
        let tables = $('.69-table');
        tables?.dataTable();
    }
  );
</script>

 <script>
   
    const confirmCreateLink = (payload={xf:''}) => {
          confirmAction(payload, 
              (p) => {
           gsl(p,
           (data) => {
                   toggleFormButton({id: 'cl',mode: 'show'});

                   if(data.status === 'ok'){
                     let ret = data.data;
                     let hh = `
                      <h5>Link Generated!</h5>
                       <p>
                         ${data.data} 
                         <a href="#" onclick="copyToClipboard('${data.data}'); return false;" class="tp-login-btn w-10">Copy</a>
                       </p>
                     `;
                    $('#cl-result').html(hh);
                    $('#cl-xf').val('');

                    /*
                    showCustomAlert({
                        title: 'Unique Link Created!',
                        text: 'You can copy the link displayed and share with the user, so he/she can complete their registration',
                        icon: 'success'
                    })
                    */
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'cl',mode: 'show'});
                    alert(`Failed to create link: ${err.toString()}`);
                }
                 )
         });
      
      }


      const confirmAddAnnouncement = (payload={t:'',m:''}) => {
          confirmAction(payload, 
              (p) => {
           aa(p,
           (data) => {
                   toggleFormButton({id: 'aa',mode: 'show'});

                   if(data.status === 'ok'){
                     
                    
                    showCustomAlert({
                        title: 'Announcement Added!',
                        text: 'You can view it in the announcements slider on the home page',
                        icon: 'success'
                    })
                    $('#aa-title').val('');
                    $('#aa-msg').val('');

                    
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'aa',mode: 'show'});
                    alert(`Failed to add announcement: ${err.toString()}`);
                }
                 )
         });
      
      }

    $(() => {
        hideFormValidations();
  

        $('#cl-btn').click(e => {
            e.preventDefault();
            hideFormValidations();
            $('#cl-result').html('');

            const xf = $('#cl-xf').val();
            
            const v = xf.length < 1;

            if(v){
              if(xf.length < 1) $('#cl-xf-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'cl',mode: 'hide'});

             const payload = {
                xf
             };
             
             confirmCreateLink(payload);
            }
            
        });


        $('#aa-btn').click(e => {
            e.preventDefault();
            hideFormValidations();
            
            const title = $('#aa-title').val(), msg = $('#aa-msg').val();
            
            const v = title.length < 1 || msg.length < 1;

            if(v){
              if(title.length < 1) $('#aa-title-validation').fadeIn();
              if(msg.length < 1) $('#aa-msg-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'aa',mode: 'hide'});

             const payload = {
                t: title,
                m: msg
             };
             
             confirmAddAnnouncement(payload);
            }
            
        });
    });
 </script>
@stop