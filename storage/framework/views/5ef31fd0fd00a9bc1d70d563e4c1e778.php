<?php
$data = [
  ['url' => url('admin'), 'icon' => "fa fa-dashboard",'label' => "Dashboard"],
  ['url' => url('products'), 'icon' => "fa fa-shopping-bag",'label' => "Products"],
  ['url' => url('categories'), 'icon' => "fa fa-list-ul",'label' => "Categories"],
  ['url' => url('orders'), 'icon' => "fa fa-credit-card",'label' => "Orders"],
  ['url' => url('users'), 'icon' => "fa fa-users",'label' => "Users"],
  ['url' => url('settings'), 'icon' => "fa fa-wrench",'label' => "Site Settings"],
  ['url' => url('senders'), 'icon' => "fa fa-send",'label' => "SMTP settings"],
  ['url' => url('plugins'), 'icon' => "fa fa-gears",'label' => "Site Plugins"],
];
?>

<div class="list-group">
   <?php
     foreach($data as $d)
     {
   ?>
       <a href="<?php echo e($d['url']); ?>" class="list-group-item list-group-item-action"> <i class="fa <?php echo e($d['icon']); ?>" style="margin-right: 5px;"></i> <?php echo e($d['label']); ?></a> 
    <?php
     }
    ?>
</div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/admin-sidebar.blade.php ENDPATH**/ ?>