<?php
$void = 'javascript:void(0)';
$title = 'Create Account';
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
'title' => $title,
'description' => "Create an account to start shopping"
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- Sign Up -->
  <div class="container mt-4">
     <div class="row">
     <div class="col-md-12">
               <h2>Registered Customers</h2>
               <p>If you have an account with us, please log in.</p>
               <div class="xs-margin"></div>
               <form id="login-form" method="get" action="#">
                  <div class="row">
                  <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-user"></span>
                            <span class="input-text">First name*</span>
                          </span> 
                          <input type="text" required="" class="form-control input-lg" id="f" placeholder="Your first name">
                         
                        </div>
                         <?php echo $__env->make('components.form-validation',['id' => 'f'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-user"></span>
                            <span class="input-text">Last name*</span>
                          </span> 
                          <input type="text" required="" class="form-control input-lg" id="l" placeholder="Your last name">
                         
                        </div>
                         <?php echo $__env->make('components.form-validation',['id' => 'l'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-email"></span>
                            <span class="input-text">Email*</span>
                          </span> 
                          <input type="text" required="" class="form-control input-lg" id="u" placeholder="Your Email">
                         
                        </div>
                         <?php echo $__env->make('components.form-validation',['id' => 'u'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-user"></span>
                            <span class="input-text">Gender*</span>
                          </span> 
                          <select required="" class="form-control input-lg" id="g">
                             <option value="none">Select an option</option>
                             <option value="male">Male</option>
                             <option value="female">Female</option>
                          </select>
                         
                        </div>
                         <?php echo $__env->make('components.form-validation',['id' => 'g'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group xs-margin">
                            <span class="input-group-addon">
                               <span class="input-icon input-icon-password"></span>
                               <span class="input-text">Password*</span>
                            </span> 
                           <input type="password" required="" class="form-control input-lg" id="p" placeholder="Your Password">
                          
                        </div>
                         <?php echo $__env->make('components.form-validation',['id' => 'p'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group xs-margin">
                            <span class="input-group-addon">
                               <span class="input-icon input-icon-password"></span>
                               <span class="input-text">Confirm Password*</span>
                            </span> 
                           <input type="password" required="" class="form-control input-lg" id="p2" placeholder="Confirm Password">
                          
                        </div>
                        <?php echo $__env->make('components.form-validation',['id' => 'p2'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     </div>
                  </div>
                 
                  <span class="help-block text-right">Existing user? <a href="<?php echo e(url('login')); ?>">Log in</a></span>
                   <?php echo $__env->make('components.button',['id' => 'signup','title' => "Submit"], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                   <?php echo $__env->make('components.form-loading',['id' => 'signup'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
               </form>
               <div class="sm-margin"></div>
            </div>
     </div>
  </div>
  <!-- Sign Up END -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
 <script>


    $(() => {
        hideFormValidations();


        $('#signup-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const fname = $('#f').val(), lname = $('#l').val(),  email = $('#u').val(),
            gender = $('#g').val(), pass = $('#p').val(), pass2 = $('#p2').val();
           
            const v = fname.length < 1 || lname.length < 1 || email.length < 1  ||
                      gender === 'none' ||  pass.length < 6 || pass2 != pass;

            if(v){
              if(fname.length < 1) $('#f-validation').fadeIn();
              if(lname.length < 1) $('#l-validation').fadeIn();
              if(email.length < 6) $('#u-validation').fadeIn();
              if(pass.length < 6) $('#p-validation').fadeIn();
              if(pass2 !== pass) $('#p2-validation').fadeIn();
              if(gender === 'none') $('#g-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'signup',mode: 'hide'});
             const payload = {
                f: fname,
                l: lname,
                e: email,
                p: pass,
                p2: pass2,
                g: gender
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/signup.blade.php ENDPATH**/ ?>