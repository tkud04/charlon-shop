<?php
$void = 'javascript:void(0)';
$title = 'Reset Password';
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('components.generic-banner',['title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- Sign Up -->
  <div class="contact-form dark-section order-lg-1 order-1">
                             
                            <!-- Sign up Form Start -->
                            <form  action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s" novalidate="true" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="row">
                                         
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="password"  class="form-control" id="pass" placeholder="Enter new Password" required="">
                                        <?php echo $__env->make('components.form-validation',['id' => 'pass'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="password" class="form-control" id="pass2" placeholder="Confirm new Password" required="">
                                        <?php echo $__env->make('components.form-validation',['id' => 'pass2'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>
                                    
            
                                    <div class="col-lg-12">
                                        <div class="contact-form-btn">
                                        <?php echo $__env->make('components.button',['id' => 'reset'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        </div>
                                        <?php echo $__env->make('components.form-loading',['id' => 'reset'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>
                                </div>
                            </form>
                            <!-- Contact Form End -->
                        </div>
  <!-- Login END -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
                x: '<?php echo e($xf); ?>'
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/reset-password.blade.php ENDPATH**/ ?>