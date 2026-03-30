<?php
$void = 'javascript:void(0)';
$title = "Welcome";
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <h1 class="title">HOT Products</h1>
        <p class="title-desc">Best sellers for <?php echo e(date("M Y")); ?></p>
    </div>
</div>
</div>

<?php echo $__env->make('components.home-slider',[
    'data' => $bxProducts
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="xlg-margin"></div>
<div class="hero-unit">
    <h2>Welcome to Venedor!</h2>
    <p>Venedor a modern and laconic theme based on Bootstrap's 12 column 1200px responsive grid system.</p>
    <span class="small-bottom-border big"></span>
</div>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('scripts'); ?>
<script>
    let slideCtr = 0;
    const slideTotal = <?php echo e(count($bxProducts)); ?>;

    const accc = (pid) => {
        console.log('slug captured: ',pid);
        const cartPayload = {
                    q: 1,
                    xf: pid
                };

                toggleFormButton({id: 'index-cart',mode: 'hide'});
               atc(
            cartPayload,
            (data) => {
                   toggleFormButton({id: 'index-cart',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Added!');
                    window.location = 'cart';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'index-cart',mode: 'show'});
                    alert(`Failed to add to cart: ${err}`);
                }
            );
    }

    const prevSlider = () => {
        const prevItem = slideCtr;
        slideCtr = prevItem - 1;

      if(slideCtr < 0){
        slideCtr = 0;
      }

      console.log('In prevSlider(), data: ',{slideTotal,prevItem,slideCtr});

      $(`.cd`).hide();
      $(`.cd-${slideCtr}`).fadeIn();

    }

    const nextSlider = () => {
        const prevItem = slideCtr;
        slideCtr = prevItem + 1;

      if(slideCtr >= slideTotal){
        slideCtr = slideTotal - 1;
      }

      console.log('In nextSlider(), data: ',{slideTotal,prevItem,slideCtr});

      $(`.cd`).hide();
      $(`.cd-${slideCtr}`).fadeIn();

    }

    $(() => {
      hideFormValidations();
      
      //Hide other carousel items
      for(let i = 1; i < <?php echo e(count($bxProducts)); ?>; i++)
      $(`.cd-${i}`).hide();
    });
   
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/index.blade.php ENDPATH**/ ?>