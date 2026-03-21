 <?php
$void = 'javascript:void(0)';
$title = "Products";
$mode = "admin";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.generic-banner',[
   'title' => "Products",
   'description' => "Here you can view and manage products"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary mb-2" href="<?php echo e(url('add-product')); ?>">+ Add Product</a>
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
					<th>Product</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                   $v = (isset($products) && count($products) > 0);

                   if($v)
                   {
                     foreach($products as $p)
                     {
                        $sid = $p['id'];
                       $ru = url('remove-product')."?xf=".$sid;
                       $images = $p['images'];
                       $category = $p['category']['title'];
                       $brand = $p['brand']['title'];
                       $img = count($images) > 0 ? $images[0]['url'] : "img/unkwown.png";
                 ?>
				  <tr>
				     <td>
                        <div class="row">
                            <div class="col-md-8">
                              <p>Title: <b><?php echo e(ucwords($p['title'])); ?></b> </p>  
                              <p>Slug: <b><?php echo e($p['slug']); ?></b> </p>
                              <p>Other Info:
                                <ul>
                                  <li>Category: <b><?php echo e($category); ?></b></li>
                                  <li>Brand: <b><?php echo e($brand); ?></b></li>
                                </ul>
                              </p>
                            </div>
                            <div class="col-md-4">
                               <img src="<?php echo e($img); ?>" class="img-responsive" style="width: 100px; height: 100px; border-radius: 10px;" alt="<?php echo e($title); ?>">
                            </div>
                        </div>
                        
                    </td>
                    <td>
                        <a href="#" id="rc-<?php echo e($sid); ?>-btn" onclick="confirmRemoveCategory({xf:'<?php echo e($sid); ?>'}); return false;" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                        <?php echo $__env->make('components.form-loading',['id' => 'rc-'.$sid], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
const confirmRemoveCategory = (payload={xf:''}) => {
    let sid = `rc-${$('#xx').val()}`;
    toggleFormButton({id: sid,mode: 'hide'});
          confirmAction(payload, 
              (p) => {
           rc(p,
           (data) => {
                 let sid = `rc-${$('#xx').val()}`;
                   toggleFormButton({id: sid,mode: 'show'});

                   if(data.status === 'ok'){         
                    alert('Category removed!');
                    window.location.reload();            
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    let sid = `rc-${$('#xx').val()}`;
                    toggleFormButton({id: sid,mode: 'show'});
                    alert(`Failed to remove category: ${err.toString()}`);
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
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/admin/products/admin-products.blade.php ENDPATH**/ ?>