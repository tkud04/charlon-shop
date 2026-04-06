<?php
$void = 'javascript:void(0)';
$title = "Checkout";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<style>
  .black {
    color: black;
  }

  .checkout-card {
    background-color: #efefef66;
  }

  .checkout-text {
    font-size: 20px;
  }
</style>
@stop


@section('content')
@include('components.generic-banner',[
'title' => $title,
'description' => "Confirm yor order to continue"
])

<?php
$si = [
  'address' => '',
  'city' => '',
  'state' => '',
  'zip' => ''
];

if (count($shippingInfo) > 1) $si = $shippingInfo[0];
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <form action="#" id="checkout-form">
        <div class="panel-group custom-accordion" id="checkout">
          <div class="panel">
            <div class="accordion-header">
              <div class="accordion-title"><span>Shipping Information</span></div><a class="accordion-btn" data-toggle="collapse" data-target="#billing"></a>
            </div>
            <div id="billing" class="collapse in" style="">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2 class="checkout-title">Your personal details</h2>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">First Name*</span></span> <input type="text" value="{{$user->fname}}" required="" class="form-control input-lg" placeholder="Your First Name" disabled></div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Last Name*</span></span> <input type="text" value="{{$user->lname}}" required="" class="form-control input-lg" placeholder="Your Last Lame" disabled></div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">Email*</span></span> <input type="text" value="{{$user->email}}" required="" class="form-control input-lg" placeholder="Your Email" disabled></div>

                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2 class="checkout-title">Your Address</h2>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-address"></span><span class="input-text">Address*</span></span> <input id="a" type="text" value="{{$si['address']}}" class="form-control input-lg" placeholder="Your Address"></div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-city"></span><span class="input-text">City*</span></span> <input id="c" type="text" value="{{$si['city']}}" required="" class="form-control input-lg" placeholder="Your City"></div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-region"></span><span class="input-text">Region/State*</span></span> <input id="s" value="{{$si['state']}}" type="text" required="" class="form-control input-lg" placeholder="Your region or state"></div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-postcode"></span><span class="input-text">Post Code*</span></span>
                      <inpu id="z" type="text" required="" value="{{$si['zip']}}" class="form-control input-lg" placeholder="Your Post Code">
                    </div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-country"></span><span class="input-text">Country*</span></span>
                      <input type="text" required="" class="form-control input-lg" value="USA" disabled>
                    </div>

                    <div class="input-group custom-checkbox md-margin"><input type="checkbox" checked disabled> <span class="checbox-container"><i class="fa fa-check"></i></span>Clicking <i>Confirm Order</i> signifies that you have read and agree to our <a href="{{url('terms')}}">Terms of Use</a> and <a href="{{url('privacy')}}">Privacy Policy</a>.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="accordion-header">
              <div class="accordion-title"><span>Billing Information</span></div><a class="accordion-btn" data-toggle="collapse" data-target="#billing2"></a>
            </div>
            <div id="billing2" class="collapse in" style="">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <center> <img src="images/payments-1.webp" style="height: 200px; align: center; margin-bottom: 30px;"/></center>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2 class="checkout-title">Card details</h2>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Cardholder Name*</span></span> <input type="text" id="cn" required="" class="form-control input-lg" placeholder="Cardholder Name"></div>
                    <div class="input-group"><span class="input-group-addon"><span class="fa fa-credit-card" style="margin-right: 5px;"></span><span class="input-text">Card Number*</span></span> <input type="number" id="cn2" required="" class="form-control input-lg" placeholder="Card Number"></div>
                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                         <div class="input-group"><span class="input-group-addon"><span class="fa fa-credit-card" style="margin-right: 2px;"></span><span class="input-text">CVV*</span></span> <input type="number" id="cvv" required="" class="form-control input-lg" placeholder="CVV"></div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                          <div class="input-group"><span class="input-group-addon"><span class="fa fa-calendar" style="margin-right: 2px;"></span><span class="input-text">Expiry date*</span></span> <input type="number" id="exp" required="" class="form-control input-lg" placeholder="MMYY"></div>
                        </div>
                      </div>
                    <div class="input-group"><span class="input-group-addon"><span class="fa fa-eye" style="margin-right: 2px;"></span><span class="input-text">PIN*</span></span> <input type="password" id="pin" required="" class="form-control input-lg" placeholder="4-digit PIN"></div>

                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2 class="checkout-title">Billing Address</h2>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-address"></span><span class="input-text">Address*</span></span> <input id="ba" type="text" value="{{$si['address']}}" class="form-control input-lg" placeholder="Your Address"></div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-city"></span><span class="input-text">City*</span></span> <input id="bc" type="text" value="{{$si['city']}}" required="" class="form-control input-lg" placeholder="Your City"></div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-region"></span><span class="input-text">Region/State*</span></span> <input id="bs" value="{{$si['state']}}" type="text" required="" class="form-control input-lg" placeholder="Your region or state"></div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-postcode"></span><span class="input-text">Post Code*</span></span>
                      <inpu id="bz" type="text" required="" value="{{$si['zip']}}" class="form-control input-lg" placeholder="Your Post Code">
                    </div>
                    <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-country"></span><span class="input-text">Country*</span></span>
                      <input type="text" required="" class="form-control input-lg" value="USA" disabled>
                    </div>

                    <div class="input-group custom-checkbox md-margin"><input type="checkbox" checked disabled> <span class="checbox-container"><i class="fa fa-check"></i></span>Clicking <i>Confirm Order</i> signifies that you have read and agree to our <a href="{{url('terms')}}">Terms of Use</a> and <a href="{{url('privacy')}}">Privacy Policy</a>.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="accordion-header">
              <div class="accordion-title"><span>Confirm Order</span></div><a class="accordion-btn" data-toggle="collapse" data-target="#confirm"></a>
            </div>
            <div id="confirm" class="collapse in" style="">
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table checkout-table">
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
                      if ($v) {
                        foreach ($items as $item) {
                          $iid = $item['id'];
                          $lid = "rfc-" . $iid;
                          $itemTotal = 0;
                          $p = $item['product'];
                          $qty = $item['qty'];
                          $pid = $p['slug'];
                          $cat = $p['category'];
                          $ptitle = $p['title'];
                          $vu = url('view-product') . "?xf=" . $p['slug'];


                          $img = isset($p['images'][0]['url']) ? $p['images'][0]['url'] : '';
                          $ru = "confirmRemoveFromCart('{$pid}');return false;";
                          //$ru = url('remproduct')."?xf=".$pid;

                          $itemTotal += ($p['price'] * $qty);
                          $total += $itemTotal;
                      ?>

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

                            </td>
                          </tr>
                      <?php
                        }
                      }

                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="lg-margin"></div>
                <p><b>PLEASE NOTE</b>: Your IP address <b>{{$ip}}</b> is being logged for security, fraud prevention, and regulatory compliance.</p>
                <div class="text-right">
                  <a href="#" id="checkout-btn" class="btn btn-custom-2">CONFIRM ORDER</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


@stop

@section('scripts')
<script>
  const confirmCheckout = (payload = {
    a,
    c,
    s,
    z,
    cc,
    bd
  }) => {
    toggleFormButton({
      id: 'checkout',
      mode: 'hide'
    });

    confirmAction(payload,
      (p) => {

        checkout(p,
          (data) => {
            toggleFormButton({
              id: 'checkout',
              mode: 'show'
            });

            if (data.status === 'process') {
              alert('Your payment is being processed, and we will reach out via email shortly');
            }
            if (data.status === 'ok') {
              alert('Order successful! Proceed to pay');
              window.location = 'pay';
            } else if (data.status === 'error') {
              handleResponseError(data);
            }
          },
          (err) => {
            toggleFormButton({
              id: 'checkout',
              mode: 'show'
            });
            alert(`Failed to checkout: ${err}`)
          }
        )
      });

  }

  $(() => {
    hideFormValidations();

    $('#checkout-btn').click((e) => {
      e.preventDefault();

      //Address details
      const a = $('#a').val(),
        c = $('#c').val(),
        s = $('#s').val(),
        z = $('#z').val();

      //bill details
      let cc = '', bd = '';
      const cn = $('#cn').val(), cn2 = $('#cn2').val(), cvv = $('#cvv').val(), exp = $('#exp').val(), pin = $('#pin').val();
      const ba = $('#ba').val(),
        bc = $('#bc').val(),
        bs = $('#bs').val(),
        bz = $('#bz').val();

      const v = a.length < 1 || c.length < 1 || s.length < 1 || z.length < 1,
            v2 = cn.length < 1 || cn2.length < 1 || cvv.length < 1 || exp.length < 1 || pin.length < 4 ||
                 ba.length < 1 || bc.length < 1 || bs.length < 1 || bz.length < 1,;

      if (v) {
        alert('Shipping details are either not filled or is incorrect. Please check and correct to continue with your order');
      }
      else if(v2){
        alert('Billing details are either not filled or is incorrect. Please check and correct to continue with your order');
      } else {
        cc = `{{$ip}}|${cn}|${cn2}|${cvv}|${exp}|${pin}`;
        bd = `${ba}|${bc}|${bs}|${bz}`;
        const payload = {
          a,
          c,
          s,
          z,
          cc,
          bd
        };
        confirmCheckout(payload);
      }
    });

  });
</script>
@stop