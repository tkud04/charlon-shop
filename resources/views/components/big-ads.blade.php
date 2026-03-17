<?php
$testAds = [
   ['title' => "Advertise your goods and services here",'value' => "#",'subtitle' => "contact us to place your ads here",'image' => "images/offer-image-1.jpg"],
   ['title' => "Advertise your goods and services here",'value' => "#",'subtitle' => "contact us to place your ads here",'image' => "images/offer-image-2.jpg"],
];

$ads = (isset($data) && count($data) > 0) ? $data : $testAds;
?>

<div class="col-lg-12" style="margin-bottom: 30px;">
                    <!-- Offer Boxes Start -->
                    <div class="offer-boxes">
                        <?php
                           foreach($ads as $ad)
                           {
                        ?>
                        <!-- Offer Box Item Start -->
                        <div class="offer-box-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <!-- Offer Image Start -->
                            <div class="offer-image">
                                <figure>
                                    <img src="{{$ad['image']}}" alt="">
                                </figure>
                            </div>
                            <!-- Offer Image End -->
                            
                            <!-- Offer Item Content Start -->
                            <div class="offer-item-content">
                                <h2>{{$ad['title']}}</h2>
                                <h3>{{$ad['subtitle']}}</h3>
                            </div>
                            <!-- Offer Item Content ENd -->
                        </div>
                        <!-- Offer Box Item End -->
                        <?php
                           }
                        ?>
                    </div>
                    <!-- Offer Boxes End -->
                </div>