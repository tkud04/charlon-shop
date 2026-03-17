<?php
$text = (isset($title) && strlen($title) > 0) ? $title : "Ukpor Unique";
$d = (isset($description)&& strlen($description) > 0) ? $description : "Official Website for Ukpor Unique Club";
?>

    <div class="tp-service-hero-area tp-service-hero-spacing p-relative z-index-1">
               <span class="tp-service-hero-shape-2 p-absolute">
                  <svg class="line-2" viewBox="0 0 402 339" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <circle cx="413.5" cy="413.5" r="353.5" transform="matrix(-1 0 0 1 820 0)" stroke="#F0F0F0" stroke-width="120"></circle>
                  </svg>
               </span>
               <div class="container">
                  <div class="row pb-25">
                     <div class="col-lg-7">
                        <div class="tp-service-hero-left p-relative mb-40">
                           <h2 class="fs-70 fs-lg-60 fs-xs-40">{{$text}}</h2>
                           <span class="tp-service-hero-shape tpswing d-none d-sm-inline-block">
                              <svg width="52" height="94" viewBox="0 0 52 94" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 16.1098C5.58433 24.0984 22.6118 44.5692 38.3295 38.0785C46.3521 34.5835 58.2264 23.6551 45.206 5.12554C40.2943 -1.86444 30.6673 -0.666183 25.559 14.1127C22.6118 22.6393 15.2441 43.0714 22.612 61.0456C26.5006 70.5321 38.1332 85.2111 49.1356 90.0043M49.1356 90.0043C44.0601 87.3414 32.8285 84.2126 28.5061 93M49.1356 90.0043C45.8611 88.1736 40.0979 80.8174 43.2414 66.0385M10.2322 38.0785C9.38015 41.6962 8.2675 54.4237 15.144 64.4094" stroke="#030303" stroke-width="1.5"></path>
                              </svg>
                           </span>
                        </div>
                     </div>
                     <div class="col-lg-5">
                        <div class="tp-service-hero-right mt-130">
                           <p class="fs-20 lh-140-per">{!! $d !!}</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tp-breadcrumb-wrap">
                  <div class="container">
                     <div class="row">
                        <div class="col-12">
                           <div class="tp-breadcrumb-list">
                              <ul>
                                 <li><a href="{{url('/')}}">Home</a></li>
                                 <li><span></span></li>
                                 <li>{{$title}}</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>