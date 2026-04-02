<?php
$void = 'javascript:void(0)';
$title = "Site Messages";
$mode = "admin";
$iap = true;
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>


<!--
<div class="my-4">
<a href="<?php echo e(url('add-s')); ?>">+ Add Setting</a>
</div>
-->

<?php echo $__env->make('components.generic-banner',[
   'title' => "Site Messages",
   'description' => "Here you can view a list of messages sent from the Contact Us form"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
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
					<th>Sender</th>
					<th>Message</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  $v = (isset($data) && count($data) > 0);

                  if($v)
                  {
                    foreach($data as $d)
                    {
                       $sid = $d['id'];
                       $ru = url('remove-site-message')."?xf=".$sid;
                       $eu = "mailto:".$d['email'];
                 ?>
				  <tr>
				     <td> 
                        <p><?php echo e(ucwords($d['name'])); ?>  <a href="<?php echo e($eu); ?>" class="btn btn-primary"><?php echo e($d['email']); ?></a></p>  
                    </td>
				     <td> 
                        <h4><?php echo e($d['subject']); ?></h4>
                        <p><?php echo e($d['body']); ?></p>  
                    </td>
                    <td>
                        <a href="#" id="rsm-<?php echo e($sid); ?>-btn" onclick="confirmRemoveMessage({xf:'<?php echo e($sid); ?>'}); return false;" class="btn btn-danger"><b>X</b>  </a>
                        <?php echo $__env->make('components.form-loading',['id' => 'rsm-'.$sid], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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


<?php $__env->startSection('scripts'); ?>
<script src="lib/datatables/datatables.min.js"></script>

<script>
const confirmRemoveMessage = (payload={xf:''}) => {
          $('#xx').val(payload.xf);
          confirmAction(payload, 
              (p) => {
           rsm(p,
           (data) => {
                 let sid = `rsm-${$('#xx').val()}`;
                   toggleFormButton({id: sid,mode: 'show'});

                   if(data.status === 'ok'){
                     
                    
                    showCustomAlert({
                        title: 'Message Removed!',
                        text: '',
                        icon: 'success'
                    })
                    window.location.reload();

                    
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    let sid = `rsm-${$('#xx').val()}`;
                    toggleFormButton({id: sid,mode: 'show'});
                    alert(`Failed to remove site message: ${err.toString()}`);
                }
                 )
         });
      
      }

  $(() => {
        let tables = $('.ukpor-table');
        tables?.dataTable();

        hideFormValidations();
    }
  );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/admin/site-messages/admin-site-messages.blade.php ENDPATH**/ ?>