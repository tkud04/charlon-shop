<?php
$void = 'javascript:void(0)';
$title = "About Us";
$userMode = "dashboard";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .about-circle{
        width: 400px;
        height: 400px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
   'title' => $title,
   'description' => "Brief overview of who we are and our core values"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/about.blade.php ENDPATH**/ ?>