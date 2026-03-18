<?php
$void = 'javascript:void(0)';
$title = $cat['title'];
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<?php
$slug = $cat['slug'];
$vu = url('category')."?xf=".$slug;
$img = $cat['img'] ? $cat['img'] : "images/unkwown.png";
?>

<?php echo $__env->make('components.category-header',[
    'img' => $img,
    'title' => $title,
    'description' => 'View all available products for this category'
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container">

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/category.blade.php ENDPATH**/ ?>