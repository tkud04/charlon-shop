<?php
$idd = isset($id) ? $id : '';
$classs = isset($class) ? $class."-loading " : '';
$msg = isset($message) ? $message : 'Processing';
?>

<div id="<?php echo e($idd); ?>-loading" class="<?php echo e($classs); ?>form-loading" style='display: flex; flex-direction: row; align-items:center;'>
   <p class=""><?php echo e($msg); ?></p>
   <img src="images/loading.gif" style="width: 50px; height: 50px; margin-left: 5px;"/>
</div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/form-loading.blade.php ENDPATH**/ ?>