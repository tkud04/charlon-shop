<?php
$void = 'javascript:void(0)';
$title = "Add Brand";
$mode = "admin";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('bodyClass','border_style html_oh'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
    <h3 style="margin-left: 10px;">Add New Brand</h3>
    <form class='form'>
    <div class="row">
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Name<span style='color: red;'>*</span></h6>
             <input class='form-control' id="pname" type="text" placeholder="Brand name" required="required">
            <?php echo $__env->make('components.form-validation',['id' => 'pname'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Slug (catchy nickname)<span style='color: red;'>*</span></h6>
             <input class='form-control' id="slug" type="text" placeholder="Brand slug" required="required" disabled>
            <?php echo $__env->make('components.form-validation',['id' => 'slug'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
         <h6 class='control-label'>Logo <span style='color: red;'>*</span></h6>
           <input type="file" id="ac-pf">
           <?php echo $__env->make('components.form-validation',['id' => 'ac-pf'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         </div>
       </div>
       
    <div class="col-md-12">
    <?php echo $__env->make('components.button',['id' => 'add-brand','title' => 'Submit'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

     <?php echo $__env->make('components.form-loading',['id' => 'add-brand'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
  $(() => {
    hideFormValidations();
    $('#pname').change(() => {
       const ret = sluggify($('#pname').val());
       $('#slug').val(ret);
    });

    $('#add-brand-btn').click((e) => {
      e.preventDefault();
      hideFormValidations();
      const slug = $('#slug').val(), title = $('#pname').val(), pf = document.querySelector('#ac-pf').files.item(0);

       const v = slug.length < 1 || title.length < 1 || pf === null;

      
       if(v){
         if(slug.length < 1) $('#slug-validation').fadeIn();
         if(title.length < 1) $('#pname-validation').fadeIn();
         if(pf === null) $('#ac-pf-validation').fadeIn();
       }
       else{
        toggleFormButton({id: 'add-brand',mode: 'hide'});

        let p = new FormData();
      p.append('title',title);
      p.append('slug',slug);
      p.append('pf',pf);

         ab(
                p,
                (data) => {
                   toggleFormButton({id: 'add-brand',mode: 'show'});

                   if(data.status !== 'error'){
                     alert('Brand added!');
                      window.location = 'brands2';
                   }
                   else{
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-brand',mode: 'show'});
                    alert(`Failed to add brand: ${err}`)
                }
            );
       }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/admin/brands/admin-add-brand.blade.php ENDPATH**/ ?>