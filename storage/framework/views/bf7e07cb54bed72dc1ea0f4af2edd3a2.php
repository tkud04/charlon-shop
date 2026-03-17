<?php
$text = (isset($title) && strlen($title) > 0) ? $title : "Charlon Shop";
$d = (isset($description) && strlen($description) > 0) ? $description : "Official Website for Ukpor Unique Club";
?>

<div id="breadcrumb-container">
   <div class="container">
      <ul class="breadcrumb">
         <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
         <li class="active"><?php echo e($text); ?></li>
      </ul>
   </div>
</div>

<div class="container">
   <header class="content-title">
      <h1 class="title"><?php echo e($text); ?></h1>
      <p class="title-desc"><?php echo e($d); ?></p>
   </header>
</div>
<?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/generic-banner.blade.php ENDPATH**/ ?>