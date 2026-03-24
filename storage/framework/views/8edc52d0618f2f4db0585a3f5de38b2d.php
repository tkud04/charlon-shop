<?php
$void = 'javascript:void(0)';
$title = $product['title'];
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.generic-banner',[
    'title' => $title,
    'description' => 'View information about this product'
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/products/product.blade.php ENDPATH**/ ?>