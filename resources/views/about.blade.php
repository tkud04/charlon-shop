<?php
$void = 'javascript:void(0)';
$title = "About Us";
$userMode = "dashboard";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<style>
    .about-circle{
        width: 400px;
        height: 400px;
    }
</style>
@stop

@section('content')
@include('components.generic-banner',[
   'title' => $title,
   'description' => "Brief overview of who we are and our core values"
  ])

<!-- About Us Section Start -->
<div class="tp-about-area pre-header fix" style="margin-top: 10px;">
               <div class="container-fluid container-1800 containers">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="tp-about-top-content d-flex justify-content-between align-items-end mb-30">
                           <p class="fs-20 lh-140-per tp-text-grey-1">
                           Ukpor Unique Club was founded in 2008 on the vision of unity, progress, and the collective development of Ukpor and its people<br>
                              We are a platform that promotes friendship, unity, community development, and cultural pride among the sons of Ukpor.
                           </p>
                           <span class="tp-about-top-shape tpswing d-none d-sm-inline-block mb-20 mr-35">
                              <svg width="53" height="94" viewBox="0 0 53 94" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0.999985 16.1314C5.66665 24.1314 23 44.6315 39 38.1314C47.1667 34.6314 59.2542 23.6875 46 5.13144C41.0001 -1.86853 31.2001 -0.668564 26.0001 14.1314C23 22.6703 15.4999 43.1315 23.0001 61.1314C26.9585 70.6315 38.8001 85.3314 50.0001 90.1314M50.0001 90.1314C44.8334 87.4648 33.4001 84.3314 29.0001 93.1314M50.0001 90.1314C46.6668 88.2981 40.8001 80.9314 44.0001 66.1314M10.398 38.1314C9.53065 41.7543 8.39801 54.5 15.398 64.5" stroke="#030303" stroke-width="1.5" />
                              </svg>
                           </span>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="tp-about-top-title-wrap ml-70 mb-30">
                           <h2 class="tp-about-top-title text-uppercase fs-70 lh-110-per"><span></span>the collective development of Ukpor and its people</h2>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row mt-30">
               <div class="col-md-4 mt-2">
                  <div class="tp-about-bottom-thumb">
                     <img class="rounded-circle about-circle" src="img/about/u5.jpg" style="" alt="">
                  </div>
               </div>
               <div class="col-md-4 mt-2">
                  <div class="tp-about-bottom-thumb">
                     <img class="rounded-circle about-circle" src="img/about/u4.jpg" style="" alt="">
                  </div>
               </div>
               <div class="col-md-4 mt-2">
                  <div class="tp-about-bottom-thumb">
                     <img class="rounded-circle about-circle" src="img/about/u3.jpg" style="" alt="">
                  </div>
               </div>
               </div>

               
</div>
<!-- About Us Section End -->

<!-- Start About Us-->
<div class="tp-about-area pt-140 pb-125">
               <div class="container">
                  <div class="row">
                     <div class="col-xxl-5 col-xl-4 col-lg-4">
                        <div class="tp-about-subtitle mb-30 tp_fade_anim" data-delay=".3">
                           <span class="tp-section-subtitle tp-ff-heading fw-500 tp-text-common-black fs-16"><span class="borders d-inline-block"></span>Who We Are</span>
                        </div>
                        <p>The foundation of this noble club was laid by a group of dedicated and visionary individuals whose commitment, sacrifice, and leadership gave birth to what the club proudly represents today.</p>
                        <p>The idea was conceived by Mr. Emeka Akunne who rallied round and met with some Ukpor Youths of like minds within same age bracket and sold the idea that it's time they come together and start contributing their quota to the development of Ukpor</p>
                        <p class="my-4">
                        The pioneer members include:
                        <ol>
                           <li>Mr. Emeka Akunne <b><i>(Convener & Pioneer Secretary General)</i></b></li>
                           <li>Mr. Chukwuka Anene <b><i>(Pioneer President)</i></b></li>
                           <li>Chief Ikenna Akpanisi</li>
                           <li>Mr. Ikenna Igwe</li>
                           <li>Mr. Emeka Elisus Ibekwe</li>
                           <li>Mr. Emeka Nnakife (Late)</li>
                           <li>Mr. Chinedu Nwokemodo (late) <b><i>(Pioneer Fin. Sec)</i></b></li>
                           <li>Chief Benjamin Chukwuma</li>
                           <li>Mr. Azuka Ifeanyi</li>
                        </ol>
                        </p>
                     </div>
                     <div class="col-xxl-7 col-xl-8 col-lg-8">
                        <div class="tp-about-content mb-30">
                           <h4 class="tp-about-title mt-4 fs-50 fs-xl-45 fs-lg-35 fw-500 lh-120-per ls-0 mb-25 tp_fade_anim" data-delay=".5"><span></span>Peace &amp; Progress</h4>
                           <div class="tp_fade_anim" data-delay=".6">
                              <p class="tp-about-para">These distinguished men came together with a shared vision to create a platform that promotes friendship, unity, community development, and cultural pride among the sons of Ukpor.</p>
                              <p class="tp-about-para"> The name Ukpor Unique Club as suggested by Mr. Emeka Akunne was to reflect the uniqueness and doggedness of Ukpor people.</p>
                              <p class="tp-about-para">Through their foresight and dedication, <a href="{{url('/')}}">Ukpor Unique Club</a> was established as a symbol of brotherhood and progress.</p>
                              <p class="tp-about-para">Today, the club continues to build on the solid foundation laid by these pioneers. Their legacy of leadership, commitment, and service remains the guiding light of Ukpor Unique Club, inspiring present and future members to uphold the values upon which the club was founded.</p>
                              <p class="tp-about-para">We honour the memories of our departed pioneers and celebrate the living founders whose vision continues to shape the club's journey.</p>
                              <a href="{{url('about')}}" class="tp-btn-lg d-inline-block lh-0 tp-round-26 fs-15 tp-bg-common-black text-uppercase ls-0 tp-btn-switch-animation tp-text-common-white hover-text-white tp-ff-heading fw-500">
                          <span class="d-flex align-items-center justify-content-center">
                             <span class="btn-text">Read more</span>
                             <span class="btn-icon">
                                <svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
                                </svg>
                             </span>
                             <span class="btn-icon">
                                <svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
                                </svg>
                             </span>
                         </span> 
                       </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tp-about-bottom pt-40 mt-30">
                     <div class="row">
                        <div class="col-lg-3">
                           <div class="tp-about-expreance d-flex align-items-end mb-30 tp_fade_anim" data-delay=".3">
                              <h2 class="fw-500 fs-100 p-relative d-inline-block mb-0 lh-1">30 <span class="plus fs-25">+</span></h2>
                              <span class="tp-ff-heading fs-18 fw-700 tp-text-common-black mb-15 ml-35">Members<br> Making a Difference</span>
                           </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                           <div class="tp-about-thumb text-end mb-30 tp_fade_anim" data-delay=".5">
                              <div class="tp-about-thumb-height mb-40 fix">
                                 <img data-speed=".9" class="img-cover" src="img/about/u2.jpg" alt="">
                              </div>
                              <img class="mr-25" src="img/about/shape.png" alt="">
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                           <div class="tp-about-thumb tp-about-thumb-height-2 fix mb-30 tp_fade_anim" data-delay=".7">
                              <img data-speed=".9" class="img-cover" src="img/about/u1.jpg" alt="">
                           </div>
                        </div>
                        <div class="col-lg-3">
                           <div class="tp-rounded-btn-wrap text-md-end mr-40 mb-30 tp_fade_anim" data-delay=".8" data-fade-from="top" data-ease="bounce">
                              <div class="btn_wrapper d-inline-block">
                                 <a href="{{url('members')}}" class="tp-btn-rounded btn-item">
                                    <span class="d-block mb-10">
                                       <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3791 3.0269C14.6431 2.80336 18.8916 1.42595 21.9998 0C20.5732 3.10763 19.1953 7.35556 18.9723 10.6196L16.8276 6.04382L1.05193 21.82C0.936264 21.9354 0.779526 22.0001 0.616152 22C0.494263 22 0.375118 21.9638 0.273781 21.8961C0.172441 21.8284 0.0934544 21.7321 0.046814 21.6195C0.000171661 21.5069 -0.0120335 21.383 0.0117397 21.2634C0.035511 21.1439 0.0941944 21.034 0.18037 20.9478L15.956 5.17221L11.3791 3.0269Z" fill="currentColor" />
                                       </svg>
                                    </span>
                                   View More
                                    <i class="tp-btn-circle-dot"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End About Us -->

@stop