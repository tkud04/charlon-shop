<?php
$void = 'javascript:void(0)';
$title = "Plugins";
$mode = "admin";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="lib/datatables/datatables.min.js"></script>

<script>

   const confirmRemovePlugin = (payload={xf:''}) => {
          confirmAction(payload, 
              (p) => {
           removePlugin({p},
                    () => {
                         alert('Plugin removed!');
                        window.location = 'plugins';
                    },
                    (err) => {
                         alert('Failed to remove plugin: ',err);
                    }
                 )
         })
      
      }

  
  $(() => {
        let tables = $('.ukpor-table');
        tables?.dataTable();
        hideFormValidations();
    }
  );
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
   'title' => "Plugins",
   'description' => "Here you can view and manage site plugins"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary" href="<?php echo e(url('add-plugin')); ?>">+ Add Plugin</a>
</div>
<div class="col-md-4">
     <div class="row">
        <div class="col-md-12 my-4">
           <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
     </div>
  </div>
  <div class="col-md-8" style="height: 400px; overflow:scroll;">

        <div class="">
              <table class="table table-hover ukpor-table">
				<thead>
				  <tr>
					<th>Title</th>
					<th>Status</th>
					<th>Date Added</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  $v = (isset($plugins) && count($plugins) > 0);

                  if($v)
                  {
                    foreach($plugins as $p)
                     {
                      $pid = $p['id'];
                      $cc = [];
                      $ru = url('remove-plugin')."?xf={$pid}";
                 ?>
				  <tr>
          <td><?php echo e($p['name']); ?></td>
					<td><?php echo e(strtoupper($p['status'])); ?></td>
					<td><?php echo e($p['date']); ?></td>
                    <td>
                        <a href="#" id="rp-<?php echo e($pid); ?>-btn" onclick="confirmRemovePlugin({xf:'<?php echo e($pid); ?>'}); return false;" class="btn btn-danger"><i class="fa-light fa-trash"></i></a>
                        <?php echo $__env->make('components.form-loading',['id' => 'rp-'.$pid], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
				  </tr>
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
            </div>
            </div>
            </div>
            <input type="hidden" id="xx" value=""/>
  </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/admin/plugins/admin-plugins.blade.php ENDPATH**/ ?>