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

@section('scripts')
<script src="lib/datatables/datatables.min.js"></script>

<script>
  const confirmRemoveFromCart = (pid) => {
          confirmAction(pid, 
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

  $(() => {
        let tables = $('.69-table');
        tables?.dataTable();
    }
  );
</script>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2 style="margin-bottom: 20px;">Shopping Cart</h2>


<div class="">
              <table class="table table-hover 69-table">
				<thead>
				  <tr>
                    <th>Product</th>
					<th>Price(&#8358;)</th>
					<th>Qty</th>
					<th>Total(&#8358;)</th>
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
                        $itemTotal = 0;
                        $p = $item['product'];
                        $qty = $item['qty'];
                        $pid = $p['slug'];
                        $cat = $p['category'];
  
                      
                       $status =  "unavailable";
                       if($p['status'] === "in-stock") $status = "in stock";
                       else if($p['status'] === "out-of-stock") $status = "out of stock";
  
                       $ru = "confirmRemoveFromCart('{$pid}');return false;";
                       //$ru = url('remproduct')."?xf=".$pid;

                       $itemTotal += ($p['price'] * $qty);
                       $total += $itemTotal;
                 ?>
				  <tr>
					<td>
                   <div class="row">
                      <div class="col-md-12">
                        <div style="display: flex;">
                             <img src = "{!! $p['image'] !!}" alt="{{$p['title']}}" style="width:100px;height:100px;"/>
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
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
            </div>
            </div>
            <div class="col-md-8" style="margin-top: 20px;"></div>
            <div class="col-md-4" style="margin-top: 20px;">
              <div class="card card-body text-end" style="margin-top: 20px; margin-top: 10px;">
                <h5 class="card-title">Subtotal:  <span class="black total-text">&#8358;{{number_format($total,2)}}</span></h5>
                <h5 class="card-title">Tax & other deductions: <span class="black total-text">&#8358;{{number_format($fee,2)}}</h5>
                <h5 class="card-title">Total: <span class="black total-text">&#8358; {{number_format($total + $fee,2)}}</h5>
              </div>
            </div>
            <div class="col-md-12">
            <div style="margin-top: 20px; margin-bottom: 10px; display:flex; align-items: center; justify-content:flex-end; ">
                              @include('components.button',[
                                'title' => 'Continue Shopping',
                                'href' => url('/'),
                                'type' => "warning"
                              ])
                               @include('components.button',[
                                'title' => 'Checkout',
                                'href' => url('checkout'),
                                'style' => "margin-left: 10px;",
                                'type' => "success"
                                ])
                            </div>
            </div>
        </div>


@stop