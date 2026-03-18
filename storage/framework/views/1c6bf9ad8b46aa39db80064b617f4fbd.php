<?php
$i = isset($img) ? $img : '';
$t = isset($title) ? $title : 'My Category';
$d = isset($description) ? $description : '';
?>
<div id="category-header">
<div class="container">
    <div class="col-2">
        <div class="category-image"><img src="<?php echo e($i); ?>" alt="<?php echo e($t); ?>" class="img-responsive"></div>
    </div>
    <div class="col-2 last">
        <div class="category-title">
            <h2><?php echo e($t); ?></h2>
            <p><?php echo $d; ?></p>
        </div>
    </div>
</div>
</div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/category-header.blade.php ENDPATH**/ ?>