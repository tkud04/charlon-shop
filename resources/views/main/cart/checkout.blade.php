<?php
$void = 'javascript:void(0)';
$title = "Checkout";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<style>

  .black{
    color: black;
  }
  .checkout-card{
    background-color: #efefef66;
  }
  .checkout-text{
     font-size: 20px;
  }
</style>
@stop

@section('scripts')

<script>
  const confirmCheckout = (pid) => {
          checkout(pid, 
              (xf) => {
           removeFromCart({xf},
                    () => {
                         alert('Item removed!');
                        window.location = 'cart';
                    },
                    (err) => {
                         alert('Failed to remove from cart: ',err);
                    }
                 )
         })
      
      }


</script>
@stop


@section('content')
<div class="container">
     <div class="row">
        <?php
          if(count($items) > 0)
          {
            $total = 0; $itemTotal = 0;
        ?>
         <div class="col-md-8">
             <div id="cart-slide" class="carousel slide" data-bs-ride="carousel">
                 <div class="carousel-inner">
                    <?php
                      for($i = 0; $i < count($items); $i++)
                      {
                        $item = $items[$i];
                        $aa = $i === 0 ? " active" : "";
                        $p = $item['product'];
                        $img = $p['image'];
                  ?>
                    ?>
                      <div class="carousel-item{{$aa}}">
                      <img src="{{$img}}" style="width: 750px; height: 400px;" class="d-block w-100" alt="{{$p['title']}}">
                      </div>
                    <?php
                      }
                    ?>
                 </div>
                 <button class="carousel-control-prev" type="button" data-bs-target="#cart-slide" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#cart-slide" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
             </div>
         </div>
         <div class="col-md-4">
            <div class="card card-body checkout-card">
               <h3 class='card-title'>Your Order</h3>

               <?php
                      for($i = 0; $i < count($items); $i++)
                      {
                        $item = $items[$i];
                        $p = $item['product'];
                        $img = $p['image'];
                        $qty = $item['qty'];

                        $itemTotal = ($p['price'] * $qty);
                        $total += $itemTotal;
                ?>
                      <p class="checkout-text black">{{$p['title']}} <b>(x{{$qty}})</b> <span class="badge text-bg-success">&#8358;{{number_format($itemTotal,2)}}</span></p>
                 <?php 
                      }
                    ?>
            </div>
            <div style="margin-top: 10px;">
          <form class='form'>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" style="padding: 10px;">
                  <h6 class='control-label'>Payment Mode<span style='color: red;'>*</span></h6>
                  <select class='form-control' id="pmode" required="required">
                     <option value="none">Select an option</option>
                      <?php
                       if(count($pmodes) > 0)
                        {
                          foreach($pmodes as $m)
                           {
                       ?>
                          <option value="{{$m['value']}}">{{$m['label']}}</option>
                       <?php
                           }
                        }
                      ?>
                   </select>
                   @include('components.form-validation',['id' => 'pmode'])
                </div>
              </div>
       
             
           </form>
          </div>
         </div>
         <div class="col-md-12">
            <div id="checkout-btn" style="margin-top: 20px; margin-bottom: 10px; display:flex; align-items: center; justify-content:flex-end; ">
                              @include('components.button',[
                                'title' => 'Continue Shopping',
                                'href' => url('/'),
                                'type' => "warning"
                              ])
                               @include('components.button',[
                                'title' => 'Checkout',
                                'href' => '#',
                                'onclick' => 'c2(); return false;',
                                'style' => "margin-left: 10px;",
                                'type' => "success"
                                ])
             </div>
             @include('components.form-loading',['id' => 'checkout'])
         </div>
         <?php
          }
         ?>
     </div>
 </div>


@stop

@section('scripts')
<script>

  $(() => {
    hideFormValidations();
    
  });

</script>
@stop