<?php
$void = 'javascript:void(0)';
$title = "Contact Us";
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
   'title' => $title,
   'description' => "Reach out to us on social media or send us a message"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/contact.blade.php ENDPATH**/ ?>