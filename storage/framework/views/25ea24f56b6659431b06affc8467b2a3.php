<?php
$t_u = isset($total_users) ? $total_users : 0;
$t_o = isset($total_orders) ? $total_orders : 0;
$t_p = isset($total_products) ? $total_products : 0;
$t_r = isset($total_refunds) ? $total_refunds : 0;
?>

<div class="row" style="padding: 10px; width: 80%; margin-left:10%;">
    <div class="col-md-3 my-3 py-3" style="margin-top: 10px; background-color: #000;">
      <p  style='font-size: 40px; font-weight: 700;' class='text-white'><?php echo e($t_u); ?></p>
      <p  style='font-size: 20px; font-weight: 700;' class='text-white'>Total<br> Users</p>
    </div>
    <div class="col-md-3 my-3 py-3" style="margin-top: 10px;background-color: #c4ee18;">
    <p  style='font-size: 40px; font-weight: 700; color: #000;'><?php echo e($t_p); ?></p>
    <p  style='font-size: 20px; font-weight: 700; color: #000;'>Total<br>Products</p>
    </div>
    <div class="col-md-3 my-3 py-3" style="margin-top: 10px;background-color: #000;">
    <p  style='font-size: 40px; font-weight: 700;' class='text-white'><?php echo e($t_o); ?></p>
    <p  style='font-size: 20px; font-weight: 700;' class='text-white'>Total<br>Orders</p>
    </div>
    <div class="col-md-3 my-3 py-3" style="margin-top: 10px;background-color: #c4ee18;">
    <p  style='font-size: 40px; font-weight: 700; color: #000;' class='text-white'><?php echo e($t_r); ?></p>
    <p  style='font-size: 20px; font-weight: 700; color: #000;' class='text-white'>Total<br>Refunds</p>
    </div>

    </div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/admin-dashboard-stats.blade.php ENDPATH**/ ?>