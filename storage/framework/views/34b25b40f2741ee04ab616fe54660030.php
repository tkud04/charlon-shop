<?php
$items = (isset($data) && count($data) > 0) ? $data : [];
?>
<div class="container">
   <div class="row">
       <div class='col-md-12'>
           <div class="hero-card">
      <?php
      if (count($items) > 0) {

         $ctr = count($items) >= 4 ? 4 : count($items);
         $imgPos = 'left';
         for ($x = 0; $x < $ctr; $x++) {
            $i = $items[$x];
            $slug = $i['slug'];
            $title = substr($i['title'],0, 50)."...";
            $img = isset($i['images'][0]) ? $i['images'][0]['url'] : '';
            $brand = $i['brand']['title'];
            $cat = $i['category']['title'];
            $vu = url('view-product')."?xf=".$slug;
            $cu = url('category')."?xf=".$i['category']['slug'];
            $bu = url('brand')."?xf=".$i['brand']['slug'];
      ?>
                 <div class="row cd cd-<?php echo e($x); ?>">
                     <div class="col-md-6">
                        <img src="<?php echo e($img); ?>" alt="<?php echo e($title); ?>" />
                     </div>
                     <div class="col-md-6">
                      <h2 style="margin-top: 20%;"><a href="<?php echo e($vu); ?>"><?php echo e($title); ?></a></h2>
                        <p><a href="<?php echo e($bu); ?>"><?php echo e($brand); ?></a> | <a href="<?php echo e($cu); ?>"><?php echo e($cat); ?></a></p>
                        <div class="btn-group" role="group" aria-label="...">
                            <a class="btn btn-default btn-lg" href="<?php echo e($vu); ?>" role="button">View more</a>
                            <a class="btn btn-custom-2 btn-lg" id="index-cart-btn" href="#" onclick="accc('<?php echo e($slug); ?>'); return false;" role="button">Add to cart</a>
                        </div>
                        
                       
                        <?php echo $__env->make('components.form-loading',['id' => 'index-cart'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     </div>
                 </div>
      <?php
         }
      }
      ?>
   </div>
   <div class="hero-controls">
      <a class="btn btn-default btn-lg" href="#" onclick="prevSlider(); return false;" role="button"><i class="fa fa-chevron-left"></i></a>
      <a class="btn btn-default btn-lg" href="#" onclick="nextSlider(); return false;" role="button"><i class="fa fa-chevron-right"></i></a>
   </div>
     
   </div>
   </div>
</div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/home-slider.blade.php ENDPATH**/ ?>