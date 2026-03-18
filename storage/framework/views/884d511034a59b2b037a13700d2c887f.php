<?php
$void = 'javascript:void(0)';
$title = "Add Setting";
$mode = "admin";
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
   'title' => "Add Gallery Item",
   'description' => "Here you can upload all required information on new gallery items"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-4">
     <div class="row">
        <div class="col-md-12 my-4">
           <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
     </div>
  </div>
  <div class="col-md-8" style="height: 400px; overflow:scroll;">
       <!-- Start form -->
 <div class="card my-4" style="width: 90%;">
        <div class="card-body">
           <h5 class="card-title">Add New Setting</h5>
           <div class="alert alert-warning" role="alert"><b>Please be careful with this</b>: Adding invalid settings could cause perfomance issues on the website!</div>
          
             <!--  Form Start -->
             <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                 <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                    <h4>Title</h4> 
                                         <input type="text" class="form-control" id="title" placeholder="Title" required="">
                                         <?php echo $__env->make('components.form-validation',['id' => 'title'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                     </div>
                                     <div class="form-group col-md-12 mb-4">
                                     <h4>Content</h4> 
                                     <input type="text" class="form-control" id="content" placeholder="Content" required="">
                                         <?php echo $__env->make('components.form-validation',['id' => 'content'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                     </div>
                                     
             
                                     <div class="col-lg-12">
                                         <div class="contact-form-btn">
                                         <?php echo $__env->make('components.button',['id' => 'add-setting'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                         </div>
                                         <?php echo $__env->make('components.form-loading',['id' => 'add-setting'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
 <script>
    $(() => {
        hideFormValidations();

        const confirmAddSetting = (payload = {xf: ''}) => {
            addSetting(
                payload,
                (data) => {
                   toggleFormButton({id: 'add-setting',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Setting added!');
                      window.location = 'settings';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-setting',mode: 'show'});
                    alert(`Failed to add setting: ${err}`);
                }
            );
        }
      

        $('#add-setting-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const title = $('#title').val(), content = $('#content').val();
           
            const v = title.length < 1 || content.length < 1;

            if(v){
              if(title.length < 1) $('#title-validation').fadeIn();
              if(content.length < 1) $('#content-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'add-setting',mode: 'hide'});
             const payload = {
                n: title,
                v: content
             };

             confirmAddSetting(payload);
            }
            
        });
    });
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/admin-add-setting.blade.php ENDPATH**/ ?>