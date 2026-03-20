<?php
$void = 'javascript:void(0)';
$title = "Senders";
$mode = "admin";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="lib/datatables/datatables.min.js"></script>

<script>

   const confirmRemoveSender = (payload={xf:''}) => {
          confirmAction(payload, 
              (p) => {
           removeSender(p,
                    () => {
                         alert('Sender removed!');
                        window.location = 'senders';
                    },
                    (err) => {
                         alert('Failed to remove senders: ',err);
                    }
                 )
         })
      
      }


      const confirmUpdateSender = (payload={xf:''}) => {
          confirmAction(payload, 
              (p) => {
           updateSender(p,
                    () => {
                         alert('Sender updated!');
                        window.location = 'senders';
                    },
                    (err) => {
                         alert('Failed to update sender: ',err);
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
   'title' => "SMTP Settings",
   'description' => "Here you can view and manage site SMTP (email) settings"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary" href="<?php echo e(url('add-sender')); ?>">+ Add Sender</a>
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
					<th>Info</th>
					<th>Current?</th>
					<th>Date Added</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  $v = (isset($senders) && count($senders) > 0);

                   if($v)
                   {
                    foreach($senders as $s)
                     {
                        $sid = $s['id'];
                       $ru = url('remove-sender')."?xf=".$sid;
                 ?>
				  <tr>
				     <td> 
                <p>SMTP server: <?php echo e($s['ss']); ?></p>
                <p>SMTP username: <?php echo e($s['se']); ?></p>
                <p>Status: <?php echo e(strtoupper($s['status'])); ?></p>
             </td>
				     <td><?php echo e(($s['current'])); ?></td>
             <td>
             <p>Date added: <?php echo e(strtoupper($s['date'])); ?></p>
             </td>
                    <td>
                        <a href="#" id="rs-<?php echo e($sid); ?>-btn" onclick="confirmRemoveSender({xf:'<?php echo e($sid); ?>'}); return false;" class="btn btn-danger"><i class="fa-light fa-trash"></i></a>
                        <a href="#" id="us-<?php echo e($sid); ?>-btn" onclick="confirmUpdateSender({xf:'<?php echo e($sid); ?>'}); return false;" class="btn btn-info"><i class="fa-light fa-paper-plane"></i></a>
                        <?php echo $__env->make('components.form-loading',['id' => 'us-'.$sid], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/admin/senders/admin-senders.blade.php ENDPATH**/ ?>