 <?php
 $predictions = (isset($data) && count($data)) ? $data : [6,7,8,8,7,8,7,8,7,8,7,8,7,8,7,8,7,8,9];
 ?>
 <!-- Todays Prediction Section Start -->
    <div class="match-highlights">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-6 col-md-10">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <div class="section-bg-title wow fadeInUp">
                            <span>predictions</span>
                        </div>
                        <h3 class="wow fadeInUp" data-wow-delay="0.2s">Bet and win today! </h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque"> {{date('jS F, Y')}}</h2>
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
                                    foreach($predictions as $p)
                                    {
                                ?>
                                 <!-- Todays Prediction Slide Start -->
                                  <div class="swiper-slide">
                                    <div class="prediction-box">
                                        <div class="stats">
                                            <i class="fa fa-trophy"></i>
                                            <span style=""> Win percentage: <div class="stats-label">90%</div></span>
                                    </div>
                                        <div class="stats">
                                            <i class="fa fa-eye"></i>
                                            <span>Win percentage: <strong>90%</strong></span>
                                        </div>
                                        <div class="stats">
                                            <i class="fa fa-eye"></i>
                                            <span>Win percentage: <strong>90%</strong></span>
                                        </div>
                                       
                                    </div>
                                  </div>
                                  <!-- Todays Prediction Slide Start -->
                                <?php
                                    }
                                  }
                                  else
                                  {
                                ?>
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