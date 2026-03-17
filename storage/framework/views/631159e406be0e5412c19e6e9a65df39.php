<?php
$void = 'javascript:void(0)';
$title = "Forgot Password";
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('components.generic-banner',[
    'title' => $title,
    'description' => "Confirm your email to reset your password"
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
                         <?php echo $__env->make('components.form-validation',['id' => 'u'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     </div>
                    
                    
                  </div>
                 
                  <?php echo $__env->make('components.button',['id' => 'fp','title' => "Submit"], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                   <?php echo $__env->make('components.form-loading',['id' => 'fp'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
               </form>
               <div class="sm-margin"></div>
            </div>
     </div>
  </div>
  <!-- Login END -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/forgot-password.blade.php ENDPATH**/ ?>