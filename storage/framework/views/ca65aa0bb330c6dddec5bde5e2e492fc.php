 <?php
$void = 'javascript:void(0)';
$title = "Brands";
$mode = "admin";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.generic-banner',[
   'title' => "Brands",
   'description' => "Here you can view and manage product brands"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary mb-2" href="<?php echo e(url('add-brand')); ?>">+ Add Brand</a>
</div>
<div class="col-md-4 mt-4">
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
					<th>Category</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                   $v = (isset($brands) && count($brands) > 0);

                   if($v)
                   {
                     foreach($brands as $c)
                     {
                        $sid = $c['id'];
                       $ru = url('remove-brand')."?xf=".$sid;
                       $img = $c['img'] ? $c['img'] : "img/unkwown.png";
                 ?>
				  <tr>
				     <td>
                        <div class="row">
                            <div class="col-md-8">
                              <p>Title: <?php echo e(ucwords($c['title'])); ?> </p>  
                              <p>Slug: <?php echo e($c['slug']); ?> </p>
                            </div>
                            <div class="col-md-4">
                               <img src="<?php echo e($img); ?>" class="img-responsive" style="width: 100px; height: 100px; border-radius: 10px;" alt="<?php echo e($title); ?>">
                            </div>
                        </div>
                        
                    </td>
                    <td>
                        <a href="#" id="rb-<?php echo e($sid); ?>-btn" onclick="confirmRemoveBrand({xf:'<?php echo e($sid); ?>'}); return false;" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                        <?php echo $__env->make('components.form-loading',['id' => 'rb-'.$sid], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
const confirmRemoveBrand = (payload={xf:''}) => {
    let sid = `rb-${$('#xx').val()}`;
    toggleFormButton({id: sid,mode: 'hide'});
          confirmAction(payload, 
              (p) => {
           rb(p,
           (data) => {
                 let sid = `rb-${$('#xx').val()}`;
                   toggleFormButton({id: sid,mode: 'show'});

                   if(data.status === 'ok'){         
                    alert('Brand removed!');
                    window.location.reload();            
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    let sid = `rb-${$('#xx').val()}`;
                    toggleFormButton({id: sid,mode: 'show'});
                    alert(`Failed to remove brand: ${err.toString()}`);
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
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/admin/brands/admin-brands.blade.php ENDPATH**/ ?>