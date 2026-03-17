<?php
$idd = isset($id) ? $id : '';
$msg = isset($message) ? $message : 'This field is required';
?>

<div id="<?php echo e($id); ?>-validation" class="help-block with-errors form-validation">
   <p style="color: red;" class="text-bold"><?php echo e($msg); ?></p>
</div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/form-validation.blade.php ENDPATH**/ ?>