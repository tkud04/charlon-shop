<?php
$void = 'javascript:void(0)';
$title = "Admin Dashboard";
$iap = true;
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.generic-banner',[
   'title' => "Admin Dashboard",
   'description' => "Welcome to the Admin Center. Here you can configure the settings for the website. You can also view/manage members information, site setttings, contact info and much more!"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Stats start -->
  <?php echo $__env->make('components.admin-dashboard-stats',[
      'total_users' => count($users),
      'total_products' => count($products),
      'total_orders' => count($orders),
      'total_refunds' => count($refunds),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>                          
<!-- Stats end -->

<div class="container mt-4">

<div class="row">
  <div class="col-md-4">
      <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                                         <?php echo $__env->make('components.form-validation',['id' => 'cl-xf'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                     </div>
                                     
             
                                     <div class="col-md-6">
                                         <a href="#" id="cl-btn" class="tp-login-btn w-100">Submit</a>
                                         <?php echo $__env->make('components.form-loading',['id' => 'cl'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                                         <?php echo $__env->make('components.form-validation',['id' => 'aa-title'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                     </div>
                                     <div class="form-group col-md-6 mb-4">
                                    <input type="text" class="form-control" id="aa-msg" placeholder="Message" required="">
                                         <?php echo $__env->make('components.form-validation',['id' => 'aa-msg'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                     </div>
                                     
             
                                     <div class="col-md-12">
                                         <a href="#" id="aa-btn" class="tp-login-btn w-100">Submit</a>
                                         <?php echo $__env->make('components.form-loading',['id' => 'aa'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                     </div>
                                 </div>
                             </form>
       </div> 
     </div>

  </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/admin/dashboard/admin-dashboard.blade.php ENDPATH**/ ?>