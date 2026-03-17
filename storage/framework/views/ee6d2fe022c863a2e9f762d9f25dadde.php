<?php
$void = 'javascript:void(0)';
$title = "Profile";
$userMode = "dashboard";
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
   'title' => "Profile",
   'description' => "Here you can find and manage your personal information. You can also find announcements here and much more!"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php
  $avatar = $profile['avatar'] ? $profile['avatar'] : "img/avatar.png";
?>

<div class="container mt-4">
     <div class="row">
     <div class="col-md-12">
     <h2 class="mx-2">Profile Info</h2>
               <div class="xs-margin"></div>
               <form id="login-form" method="get" action="#">
                  <div class="row">
                  <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-user"></span>
                            <span class="input-text">First name*</span>
                          </span> 
                          <input type="text" required="" class="form-control input-lg" id="f" placeholder="Your first name" value="<?php echo e($user->fname); ?>" disabled>
                         
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-user"></span>
                            <span class="input-text">Last name*</span>
                          </span> 
                          <input type="text" required="" class="form-control input-lg" id="l" placeholder="Your last name" value="<?php echo e($user->lname); ?>" disabled>
                         
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-email"></span>
                            <span class="input-text">Email*</span>
                          </span> 
                          <input type="text" required="" class="form-control input-lg" id="u" placeholder="Your Email" value="<?php echo e($user->email); ?>" disabled>
                         
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <span class="input-icon input-icon-user"></span>
                            <span class="input-text">Gender*</span>
                          </span> 
                          <select required="" class="form-control input-lg" id="g" disabled>
                             <option value="none">Select an option</option>
                             <?php
                               $ret = [
                                 ['label' => 'Male', 'value' => 'male'],
                                 ['label' => 'Female', 'value' => 'female'],
                               ];

                               foreach($ret as $g)
                               {
                                 $ss = $g['value'] === $user->gender ? "selected='selected'" : ''; 
                             ?>
                             <option value="<?php echo e($g['value']); ?>"<?php echo e($ss); ?>>Male</option>
                             <?php
                               }
                             ?>
                          </select>
                         
                        </div>

                     </div>
                  </div>

               </form>
               <div class="sm-margin"></div>
            </div>
     </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/profile.blade.php ENDPATH**/ ?>