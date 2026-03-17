<?php
$wallet = isset($data) ? $data : ['points' => '0','withdrawable' => '0'];
?>

<div class="col-md-12"><h3 style="margin-top: 10px; margin-bottom: 10px;">Wallet</h3></div>
  <div class="col-md-6">
    <div style="margin-top: 10px;" style="width: 100%;">
                         <div class="faqs-image-box-1" style="width: 100% !important;">
                            <div class="faq-contact-box bg-safebets wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="icon-box">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="faq-contact-box-content">
                                    <h3>Points</h3>
                                    <p style="font-size: 18px;"><a href="{{$void}}">{{$wallet['points']}}</a></p>
                                </div>
                            </div>
                        </div>
    </div>
    </div>
    <div class="col-md-6">
    <div style="margin-top: 10px;">
                         <div class="faqs-image-box-1" style="width: 100% !important;">
                            <div class="faq-contact-box bg-safebets wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="icon-box">
                                    <i class="fa fa-bank"></i>
                                </div>
                                <div class="faq-contact-box-content">
                                    <h3>Amount Withdrawable</h3>
                                    <p style="font-size: 18px;"><a href="{{$void}}">&#8358;{{number_format($wallet['withdrawable'],2)}}</a></p>
                                </div>
                            </div>
                        </div>
    </div>
  </div>