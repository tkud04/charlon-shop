<?php
 $t = (isset($title)) ? $title : "predictions";
 $predictions = (isset($data) && count($data) > 0) ? $data : [];
 ?>
 <!-- Todays Prediction Section Start -->
    <div class="match-highlights">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-6 col-md-10">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <div class="section-bg-title wow fadeInUp">
                            <span>{{date('jS M, Y')}}</span>
                        </div>
                        <h3 class="wow fadeInUp" data-wow-delay="0.2s">Bet and win today! </h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque"> {{$t}}</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Match Highlight Slider Start -->
                    <div class="match-highlight-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php
                                  if(count($predictions) > 0)
                                  {
                                    foreach($predictions as $prediction)
                                    {
                                        $p = $prediction['predictions'];
                                        
                                        $seller = $prediction['seller'];
                                        $seller_name = $seller['fname'].' '.substr($seller['lname'],0,1);
                                        $tag = $seller['username'];
                                        $rating = $seller['rating']['rating']; $v = intval($rating) > 80;
                                        $ratingColor = $v ? "green" : "red";
                                        $ratingIcon = $v ? "fa-arrow-up" : "fa-arrow-down";                

                                        $vv = $prediction['hasFreePrediction'];
                                        $vu = $vv ?  url("seller")."?xf=".$tag : "#";
                                        $totalCount = 0;

                                        if($vv)
                                        {
                                            $freeCount = 0; 
                                            $activeCount = count($p['active']); $expiredCount = count($p['expired']);
                                            $totalCount = $activeCount + $expiredCount;
                                            $predictionText = ($totalCount >= 0 && $totalCount !== 1) ? 'Predictions' : 'Predictions';
    
                                            foreach($p['active'] as $pp)
                                            {
                                                if($pp['free'] === 'yes') $freeCount += 1;
                                            }
                                        }
                                        

                                ?>
                                 <!-- Todays Prediction Slide Start -->
                                  <div class="swiper-slide">
                                    <a href="{{$vu}}">
                                    <div class="prediction-box">
                                         <h2 style="color: #ffffff;"><b>{{ucwords($tag)}}</b></h2>
                                         @if($vv)
                                         <h3 style="color: #ffffff;"> {{$totalCount}} {{$predictionText}}</h3>
                                         <div class="flex-row stats align-center">
                                            <i class="fa fa-trophy"></i>
                                            <span class="flex-row flex-center" style="color: #ffffff;">
                                                 Win rate: <span class="stats-label" style="background-color: {{$ratingColor}}">{{$rating}}%</span>
                                                 <i class="fa {{$ratingIcon}}" style="margin-left: 5px; color: #ffffff;"></i>
                                            </span>
                                         </div>
                                         <div class="stats" style="color: #ffffff;">
                                            <i class="fa fa-calendar"></i>
                                            <span>Free predictions: <span class="stats-label" style="background-color: #000000;"> {{$freeCount}} </span></span>
                                         </div>
                                         @else
                                         <h3 style="color: orange;">No free prediction(s) in this ticket</h3>
                                         @endif
                                       
                                    </div>
                                    </a>
                                  </div>
                                  <!-- Todays Prediction Slide Start -->
                                <?php
                                    }
                                  }
                                  else
                                  {
                                ?>
                                 <div class="row">
                                    <div class="col-md-6">
                                      <img src="images/leagues-1.png" style="width: 200px; height: 200px;"/>
                                    </div>
                                    <div class="col-md-6">
                                      <h2>Predictions coming soon..</h2>
                                      <p>Please check back for more predictions</p>
                                    </div>
                                 </div>
                                 
                                <?php
                                  }
                                ?>
                            </div>
                            <div class="match-highlight-btn">
                                <div class="match-highlight-btn-prev"></div>
                                <div class="match-highlight-btn-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Match Highlight Slider End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Todays Prediction Section End -->