<?php
$void = 'javascript:void(0)';
$title = "Welcome";
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.home-slider',[
    'data' => $bxProducts
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    const addToCart = (pid) => {
        console.log('slug captured: ',pid);
    }
    $(() => {
      $('#bxCarousel').carousel();
    });
   
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/index.blade.php ENDPATH**/ ?>