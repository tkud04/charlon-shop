<?php
$void = 'javascript:void(0)';
$title = "Brands";
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
'title' => $title,
'description' => "View all available product brands"
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container">
<div class="row portfolio-item-container" data-maxcolumn="3" data-layoutmode="fitRows">
    <?php
     $v = isset($brands) && count($brands) > 0;

     if($v)
     {
        foreach($brands as $b)
        {
           $slug = $b['slug'];
           $vu = url('brand')."?xf=".$slug;
           $img = $b['img'] ? $b['img'] : "images/unkwown.png";
    ?>
    <div class="col-md-4 col-sm-4 col-xs-4 portfolio-item photography">
        <figure><img src="<?php echo e($img); ?>" alt="<?php echo e($b['title']); ?>">
            <figcaption>
                <a href="<?php echo e($img); ?>" title="<?php echo e($b['title']); ?>" data-rel="prettyPhoto[portfolio]" class="zoom-button"></a> 
                <a href="<?php echo e($vu); ?>" class="link-button"></a> 
                <a href="#" class="like-button"><i class="fa fa-heart"></i><span>0</span></a>
            </figcaption>
        </figure>
        <h2><a href="<?php echo e($vu); ?>"><?php echo e($b['title']); ?></a></h2>
        <p><a href="<?php echo e($vu); ?>"><?php echo e($b['product_count']); ?> items</a></p>
    </div>
    <?php
        }
     }
    ?>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/brands/brands.blade.php ENDPATH**/ ?>