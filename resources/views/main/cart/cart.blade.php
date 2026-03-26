<?php
$void = 'javascript:void(0)';
$title = "Cart";
?>
@extends('layout')

@section('title',$title)

@section('styles')
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
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2 style="margin-bottom: 20px;">Shopping Cart</h2>


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
                             <img src = "{!! $img !!}" alt="{{$p['title']}}" style="width:100px;height:100px;"/>
                             <div style="margin-left: 10px; margin-top: 10px;">
                                <h4>{{$p['title']}}</h4>         
                                <h5><i>{{$cat['title']}}</i></h5>    
                             </div>
                        <div></div>
                        </div>
                    </div>
                 </div>
               
          </td>
          <td>    
               <p style="margin-top: 10px;">{{number_format($p['price'],2)}}</p>
          </td>
		  <td>
               <p style="margin-top: 10px;">{{number_format($qty,2)}}</p>
          </td>
          <td>
               <p style="margin-top: 10px;">{{number_format($itemTotal,2)}}</p>
          </td>
          <td>
             <p style="margin-top: 10px;"><a type="button" href="{{$void}}" onclick="{{$ru}}" class="btn-close"></a></p>
          </td>
				  </tr>
                    -->
          <tr>
                                <td class="item-name-col">
                                    <figure><a href="{{$vu}}"><img src="{{$img}}" alt="{{$ptitle}}"></a></figure>
                                    <header class="item-name"><a href="{{$vu}}">{{$ptitle}}</a></header>
                                    <p class="item-code">{{$pid}}</p>
                                </td>
                                <td class="item-price-col">
                                  <span class="item-price-special">${{number_format($p['price'],2)}}</span>
                                </td>
                                <td class="item-price-col">
                                <span class="item-price-special">x{{$qty}}</span>
                                </td>
                                <td class="item-total-col">
                                  <span class="item-price-special">${{number_format($itemTotal,2)}}</span> 
                                  <a id="{{$lid}}" href="#" onclick="confirmRc('{{$iid}}'); return false;" class="close-button"></a>
                                  @include('components.form-loading',[
                                    'id' => $lid,
                                    'size' => 20,
                                    'noMsg' => true
                                    ])
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
                      <p>Price: $80</p>
                    </dd>
                    <dt class="col-md-3">Others</dt>
                    <dd class="col-md-9">
                      <p>States: other states in the USA</p>
                      <p>Price: $50</p>
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
                    <td>${{number_format($itemTotal,2)}}</td>
                </tr>
                <tr>
                    <td class="total-table-title">Shipping:</td>
                    <td>$250.00</td>
                </tr>
                <tr>
                    <td class="total-table-title">TAX (0%):</td>
                    <td>$0.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>Total:</td>
                    <td>${{number_format($itemTotal + 250,2)}}</td>
                </tr>
            </tfoot>
        </table>
        <div class="md-margin"></div>
        <a href="{{url('categories')}}" class="btn btn-custom-2">CONTINUE SHOPPING</a> 
        <a href="{{url('checkout')}}" class="btn btn-custom">CHECKOUT</a>
    </div>
  
        </div>


@stop

@section('scripts')
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
@stop