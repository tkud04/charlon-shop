<?php
$void = 'javascript:void(0)';
$title = $cat['title'];
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<?php
$slug = $cat['slug'];
$cu = url('category')."?xf=".$slug;
$img = $cat['img'] ? $cat['img'] : "images/unkwown.png";
?>

<?php echo $__env->make('components.category-header',[
    'img' => $img,
    'title' => $title,
    'description' => 'View all available products for this category'
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container">
   <div class="row mt-4">
        <div class="col-md-12">
           <div class="row">
           <div class="col-md-9 col-sm-8 col-xs-12 main-content">
            <?php if(count($products) > 0): ?>
               <?php echo $__env->make('components.pagination2',[
                  'page' => $page,
                  'totalpages' => $totalPages,
                  'url' => $cu
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
             <?php endif; ?>
               <div></div>
               <div class="category-item-container">
               <div class="row">
                  <?php
                    $v = isset($products) && count($products) > 0;

                    if($v)
                    {
                     foreach($products as $p)
                     {
                        $pid = $p['slug'];
                        $vu = url('view-product')."?xf=".$pid;
                        $imgs = $p['images']; $img = count($imgs) > 0 ? $imgs[0]['url'] : '';
                        $pname = substr($p['title'],0,50)."...";
                        $formerPrice = $p['formerPrice']; $newPrice = $p['newPrice'];
                  ?>
                     <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="item item-hover">
                    <div class="item-image-wrapper">
                      <figure class="item-image-container">
                        <a href="<?php echo e($vu); ?>">
                          <img src="<?php echo e($img); ?>" alt="<?php echo e($pname); ?>" class="item-image">
                          <img src="<?php echo e($img); ?>" alt="<?php echo e($pname); ?>" class="item-image-hover">
                        </a>
                      </figure>
                      <div class="item-price-container">
                        <span class="old-price">$<?php echo e($formerPrice); ?><span class="sub-price">.99</span>
                        </span>
                        <span class="item-price">$<?php echo e($newPrice); ?> <span class="sub-price">.99</span>
                        </span>
                      </div>
                     <span class="discount-rect">-15%</span>
                    </div>
                    <div class="item-meta-container">
                      <div class="ratings-container">
                        <div class="ratings">
                          <div class="ratings-result" data-result="80" style="width: 75.2px;"></div>
                        </div>
                        <span class="ratings-amount" style="display: none;">5 Reviews</span>
                      </div>
                      <h3 class="item-name">
                        <a href="<?php echo e($vu); ?>"><?php echo e($pname); ?></a>
                      </h3>
                      <div class="item-action">
                        <a href="#" class="item-add-btn">
                          <span class="icon-cart-text">Add to Cart</span>
                        </a>
                        <div class="item-action-inner" style="visibility: hidden; overflow: hidden; padding-left: 0px; width: 0px;">
                          <a href="#" class="icon-button icon-like">Favourite</a>
                          <a href="#" class="icon-button icon-compare">Checkout</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <?php
                    }
                     }
                  ?>
               </div>
               </div>
               <div class="pagination-container clearfix">
              <div class="pull-right">
                <?php if(count($products) > 0): ?>
                <?php echo $__env->make('components.pagination2',[
                  'page' => $page,
                  'totalpages' => $totalPages,
                  'url' => $cu
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
              </div>
            </div>
           </div>
           <aside class="col-md-3 col-sm-4 col-xs-12 mt-4 sidebar">
               <?php echo $__env->make('components.category-sidebar',[
                 'data' => $categories
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
           </aside>
           </div>
        </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/categories/category.blade.php ENDPATH**/ ?>