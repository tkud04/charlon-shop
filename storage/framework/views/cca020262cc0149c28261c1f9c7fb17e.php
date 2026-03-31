<?php
$t = isset($title) ? $title : '';
$s = isset($subtitle) ? $subtitle : '';
$s2 = isset($style) ? ' style="'.$style.'"' : '';
?>

<div class="container">
   <div class="row"<?php echo $s2; ?>>
      <div class="col-md-12">
           <h1 class="title"><?php echo e($t); ?></h1>
           <p class="title-desc"><?php echo e($s); ?></p>
       </div>
    </div>
</div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/widget-header.blade.php ENDPATH**/ ?>