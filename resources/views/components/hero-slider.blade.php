<?php

?>
<?php
$title = isset($data['title']) ? $data['title'] : '';
$subtitle = isset($data['subtitle']) ? $data['subtitle'] : '';
$points = isset($data['points']) ? $data['points'] : '';
$description = isset($data['description']) ? $data['description'] : '';
$btn_url_1 = isset($data['btn_url_1']) ? $data['btn_url_1'] : '';
$btn_text_1 = isset($data['btn_text_1']) ? $data['btn_text_1'] : '';
$btn_url_2 = isset($data['btn_url_2']) ? $data['btn_url_2'] : '';
$btn_text_2 = isset($data['btn_text_2']) ? $data['btn_text_2'] : '';
$img = isset($data['image']) ? "images/banners/".$data['image'] : '';

$pointsArr = explode("|",$points);
?>

<!-- Hero Section Start -->
<div class="hero dark-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Hero Content Start -->
                    <div class="hero-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{$title}}</h3>
                            <h1 class="text-anime-style-2" data-cursor="-opaque">{!! $subtitle !!}</h1>
                        </div>
                        <!-- Section Title End -->

                        <!-- Hero Content List Start -->
                        <div class="hero-content-list wow fadeInUp" data-wow-delay="0.2s">
                            <ul>
                                <?php
                                 foreach($pointsArr as $pa)
                                 {
                                ?>
                                <li>{!! $pa !!}</li>
                                <?php
                                 }
                                ?>
                            </ul>
                        </div>
                        <!-- Hero Content List End -->

                        <!-- Hero Content Body Start -->
                        <div class="hero-content-body wow fadeInUp" data-wow-delay="0.4s">
                            <p>{!! $description !!}</p>
                        </div>
                        <!-- Hero Content Body End -->

                        <!-- Hero Button Start -->
                        <div class="hero-btn wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{$btn_url_1}}" class="btn-default btn-highlighted">{{$btn_text_1}}</a>
                            <a href="{{$btn_url_2}}" class="btn-default btn-highlighted btn-transparent">{{$btn_text_2}}</a>
                        </div>
                        <!-- Hero Button End -->
                    </div>
                    <!-- Hero Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- Hero Image Start -->
                    <div class="hero-image">
                        <figure>
                            <img src="{{$img}}" alt="">
                        </figure>
                    </div>
                    <!-- Hero Image End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->