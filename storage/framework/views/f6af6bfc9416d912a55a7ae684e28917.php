<?php
$void = 'javascript:void(0)';
$title = "Add Product";
$mode = "admin";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('bodyClass','border_style html_oh'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
    <h3 style="margin-left: 10px;">Add New Product</h3>
    <form class='form'>
    <div class="row">
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Name<span style='color: red;'>*</span></h6>
             <input class='form-control' id="pname" type="text" placeholder="Product name" required="required">
            <?php echo $__env->make('components.form-validation',['id' => 'pname'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Slug (catchy nickname)<span style='color: red;'>*</span></h6>
             <input class='form-control' id="slug" type="text" placeholder="Product nickname" required="required" disabled>
            <?php echo $__env->make('components.form-validation',['id' => 'slug'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Category<span style='color: red;'>*</span></h6>
             <select class='form-control' id="pcat" required="required">
              <option value="none">Select an option</option>
              <?php
                if(count($categories) > 0)
                {
                   foreach($categories as $c)
                    {
              ?>
                 <option value="<?php echo e($c['slug']); ?>"><?php echo e($c['title']); ?></option>
              <?php
                    }
                }
              ?>
             </select>
            <?php echo $__env->make('components.form-validation',['id' => 'pcat'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Brand<span style='color: red;'>*</span></h6>
             <select class='form-control' id="pbrand" required="required">
              <option value="none">Select an option</option>
              <?php
                if(count($brands) > 0)
                {
                   foreach($brands as $b)
                    {
              ?>
                 <option value="<?php echo e($b['slug']); ?>"><?php echo e($b['title']); ?></option>
              <?php
                    }
                }
              ?>
             </select>
            <?php echo $__env->make('components.form-validation',['id' => 'pbrand'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-12">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Description<span style='color: red;'>*</span></h6>
            <div id="ap-description"></div>
            <?php echo $__env->make('components.form-validation',['id' => 'ap-description'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
           <h6 class='control-label'>Image #1<span style='color: red;'>*</span></h6>
           <input type="file" id="ap-pf">
           <?php echo $__env->make('components.form-validation',['id' => 'ap-pf'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
         <h6 class='control-label'>Image #2<span style='color: red;'>*</span></h6>
           <input type="file" id="ap-fp">
           <?php echo $__env->make('components.form-validation',['id' => 'ap-fp'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Price(&#8358;)<span style='color: red;'>*</span></h6>
             <input class='form-control' id="price" type="number" placeholder="Product price" required="required">
            <?php echo $__env->make('components.form-validation',['id' => 'price'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Status<span style='color: red;'>*</span></h6>
             <select class='form-control' id="pstatus" required="required">
              <option value="none">Select an option</option>
              <?php
                if(count($statuses) > 0)
                {
                   foreach($statuses as $st)
                    {
              ?>
                 <option value="<?php echo e($st['value']); ?>"><?php echo e($st['label']); ?></option>
              <?php
                    }
                }
              ?>
             </select>
             <?php echo $__env->make('components.form-validation',['id' => 'pstatus'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
    </div>
    <div class="col-md-12">
    <?php echo $__env->make('components.button',['id' => 'add-product','title' => 'Submit'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

     <?php echo $__env->make('components.form-loading',['id' => 'add-product'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="lib/ckeditor/ckeditor.js"></script>
<script>
  const confirmAddProduct = (payload = new FormData()) => {
          confirmAction(payload, 
              (p) => {

           ap(p,
           (data) => {
                   toggleFormButton({id: 'add-product',mode: 'show'});

                   if(data.status === 'ok'){
                     alert('Product added!');
                      window.location = 'products';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-product',mode: 'show'});
                    alert(`Failed to add product: ${err}`)
                }
                 )
         });
      
      }

  $(() => {
    hideFormValidations();
    initHTMLEditor('ap-description');

    $('#pname').change(() => {
       const ret = sluggify($('#pname').val());
       $('#slug').val(ret);
    });

    $('#add-product-btn').click((e) => {
      e.preventDefault();
      hideFormValidations();
     
      const slug = $('#slug').val(), category = $('#pcat').val(), title = $('#pname').val(),
            brand = $('#pbrand').val(), description = CKEDITOR.instances['ap-description'].getData(), price = $('#price').val(),
            status = $('#pstatus').val(), pf = document.querySelector('#ap-pf').files.item(0), fp = document.querySelector('#ap-fp').files.item(0);

            console.log('price: ',price);
       const v = slug.length < 1 || category === 'none' || brand === 'none' || title.length < 1 ||
                 description.length < 1 || pf === null ||  fp === null || (price.length < 1 || parseFloat(price) < 1) || status === 'none';


       if(v){
         if(slug.length < 1) $('#slug-validation').fadeIn();
         if(category === 'none' ) $('#pcat-validation').fadeIn();
         if(brand === 'none' ) $('#pbrand-validation').fadeIn();
         if(title.length < 1) $('#pname-validation').fadeIn();
         if(description.length < 1) $('#ap-description-validation').fadeIn();
         if(price.length < 1 || parseFloat(price) < 1) $('#price-validation').fadeIn();
        if(status === 'none') $('#pstatus-validation').fadeIn();
        if(pf === null) $('#ap-pf-validation').fadeIn();
        if(fp === null) $('#ap-fp-validation').fadeIn();
       }
       else{
        toggleFormButton({id: 'add-product',mode: 'hide'});

        const p = new FormData();
         p.append('title',title);
         p.append('slug',slug);
         p.append('category',category);
         p.append('brand',brand);
         p.append('description',description);
         p.append('price',price);
         p.append('status',status);
         p.append('pf',pf);
         p.append('fp',fp);

         confirmAddProduct(p);
       }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/admin/products/admin-add-product.blade.php ENDPATH**/ ?>