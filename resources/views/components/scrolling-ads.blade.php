 <?php
 $testAds = [
    ['name' => "bet and win",'value' => "#",'image' => "images/icon-football.svg"],
    ['name' => "advertise here",'value' => "#",'image' => "images/icon-football.svg"],
    ['name' => "bet and win",'value' => "#",'image' => "images/icon-football.svg"],
    ['name' => "advertise here",'value' => "#",'image' => "images/icon-football.svg"],
    ['name' => "bet and win",'value' => "#",'image' => "images/icon-football.svg"],
    ['name' => "advertise here",'value' => "#",'image' => "images/icon-football.svg"],
 ];

 $ads = (isset($data) && count($data) > 0) ? $data : $testAds;
 ?>
 <!-- Scrolling Ticker Section Start -->
        <div class="our-scrolling-ticker">
            <!-- Scrolling Ticker Start -->
            <div class="scrolling-ticker-box">


                <div class="scrolling-content">
                    <?php
                      foreach($ads as $ad)
                      {
                    ?>
                      <span>
                        <img src="images/ads/{{$ad['image']}}" alt="">
                        <a class="text-white" href="{!! $ad['value'] !!}">{!! $ad['name'] !!}</a>
                      </span>
                    <?php
                      }
                    ?>
                </div>
            </div>
        </div>
        <!-- Scrolling Ticker Section End -->