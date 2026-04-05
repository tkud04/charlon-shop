<?php
$void = 'javascript:void(0)';
$title = "Cart";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<style>
  .black{
    color: black;
  }
  .total-text{
    font-size: 30px;
  }

  .card-title{
    margin-bottom: 25px;
  }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
'title' => $title,
'description' => "View items in your cart and checkout"
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

<div class="">
<table class="table cart-table">
				<thead>
				  <tr>
                    <th>Product</th>
					<th>Price($)</th>
					<th>Qty</th>
					<th>Subtotal($)</th>
          <th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  $v = (isset($items) && count($items) > 0);
                  $total = 0; 
                  if($v)
                  {
                    foreach($items as $item)
                    {
                      $iid = $item['id'];
                      $lid = "rfc-".$iid;
                        $itemTotal = 0;
                        $p = $item['product'];
                        $qty = $item['qty'];
                        $pid = $p['slug'];
                        $cat = $p['category'];
                        $ptitle = $p['title'];
                        $vu = url('view-product')."?xf=".$p['slug'];
  
                      
                        $img = isset($p['images'][0]['url']) ? $p['images'][0]['url'] : '';
                       $ru = "confirmRemoveFromCart('{$pid}');return false;";
                       //$ru = url('remproduct')."?xf=".$pid;

                       $itemTotal += ($p['price'] * $qty);
                       $total += $itemTotal;
                 ?>
            <!--
				  <tr>
					<td>
                   <div class="row">
                      <div class="col-md-12">
                        <div style="display: flex;">
                             <img src = "<?php echo $img; ?>" alt="<?php echo e($p['title']); ?>" style="width:100px;height:100px;"/>
                             <div style="margin-left: 10px; margin-top: 10px;">
                                <h4><?php echo e($p['title']); ?></h4>         
                                <h5><i><?php echo e($cat['title']); ?></i></h5>    
                             </div>
                        <div></div>
                        </div>
                    </div>
                 </div>
               
          </td>
          <td>    
               <p style="margin-top: 10px;"><?php echo e(number_format($p['price'],2)); ?></p>
          </td>
		  <td>
               <p style="margin-top: 10px;"><?php echo e(number_format($qty,2)); ?></p>
          </td>
          <td>
               <p style="margin-top: 10px;"><?php echo e(number_format($itemTotal,2)); ?></p>
          </td>
          <td>
             <p style="margin-top: 10px;"><a type="button" href="<?php echo e($void); ?>" onclick="<?php echo e($ru); ?>" class="btn-close"></a></p>
          </td>
				  </tr>
                    -->
          <tr>
                                <td class="item-name-col">
                                    <figure><a href="<?php echo e($vu); ?>"><img src="<?php echo e($img); ?>" alt="<?php echo e($ptitle); ?>"></a></figure>
                                    <header class="item-name"><a href="<?php echo e($vu); ?>"><?php echo e($ptitle); ?></a></header>
                                    <p class="item-code"><?php echo e($pid); ?></p>
                                </td>
                                <td class="item-price-col">
                                  <span class="item-price-special">$<?php echo e(number_format($p['price'],2)); ?></span>
                                </td>
                                <td class="item-price-col">
                                <span class="item-price-special">x<?php echo e($qty); ?></span>
                                </td>
                                <td class="item-total-col">
                                  <span class="item-price-special">$<?php echo e(number_format($itemTotal,2)); ?></span> 
                                  <a id="<?php echo e($lid); ?>" href="#" onclick="confirmRc('<?php echo e($iid); ?>'); return false;" class="close-button"></a>
                                  <?php echo $__env->make('components.form-loading',[
                                    'id' => $lid,
                                    'size' => 20,
                                    'noMsg' => true
                                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
    <div class="row">
    <div class="lg-margin"></div>
         <div class="col-md-8 col-sm-12 col-xs-12 lg-margin">
        <div class="tab-container left clearfix">
            <ul class="nav-tabs" style="height: 340px;">
                <li class="active"><a href="#shipping" data-toggle="tab">Shipping &amp; Taxes</a></li>
                <li><a href="#discount" data-toggle="tab">Discount Codes</a></li>
            </ul>
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="shipping">
                   <dl class="row">
                    <dt class="col-md-3">Zone 1</dt>
                    <dd class="col-md-9">
                      <p>States: California, New York, Nevada, Florida</p>
                      <p>Price: $30</p>
                    </dd>
                    <dt class="col-md-3">Others</dt>
                    <dd class="col-md-9">
                      <p>States: other states in the USA</p>
                      <p>Price: $30</p>
                    </dd>
                   </dl>
                </div>
                <div class="tab-pane" id="discount">
                    <p>Enter your discount coupon code here.</p>
                    <form action="#">
                        <div class="input-group"><input type="text" required="" class="form-control" placeholder="Coupon code"></div><input type="submit" class="btn btn-custom-2" value="APPLY COUPON">
                    </form>
                </div>
               
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <table class="table total-table">
            <tbody>
                <tr>
                    <td class="total-table-title">Subtotal:</td>
                    <td>$<?php echo e(number_format($total,2)); ?></td>
                </tr>
                <tr>
                    <td class="total-table-title">Shipping:</td>
                    <td>$30.00</td>
                </tr>
                <tr>
                    <td class="total-table-title">TAX (0%):</td>
                    <td>$0.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>Total:</td>
                    <td>$<?php echo e(number_format($total + 30,2)); ?></td>
                </tr>
            </tfoot>
        </table>
        <div class="md-margin"></div>
        <a href="<?php echo e(url('categories')); ?>" class="btn btn-custom-2">CONTINUE SHOPPING</a> 
        <a href="<?php echo e(url('checkout')); ?>" class="btn btn-custom">CHECKOUT</a>
    </div>
  
        </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>
     hideFormValidations();
    const confirmRc = (id) => {
      const payload = {xf: id};
      const lid = `rfc-${id}`; 

      toggleFormButton({id: lid,mode: 'hide'});

      confirmAction(payload, 
              (p) => {

           rffc(p,
           (data) => {
                   toggleFormButton({id: lid,mode: 'show'});

                   if(data.status === 'ok'){
                     alert('Removed!');
                      window.location = 'cart';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: lid,mode: 'show'});
                    alert(`Failed to remove from cart: ${err}`)
                }
                 )
         });
    }

    $(document).ready(() => {
      console.log('d: test');
      hideFormValidations();
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/cart/cart.blade.php ENDPATH**/ ?>