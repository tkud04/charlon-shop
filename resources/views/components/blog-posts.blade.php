<div class="our-blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start --
                    <div class="section-title section-title-center">
                        <div class="section-bg-title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <span>Blog</span>
                        </div>
                        <h2 class="text-anime-style-2" data-cursor="-opaque"><div style="position:relative;display:inline-block;">Latest posts from SafeBets NG</h2>
                    </div>
                    <!-- Section Title End --
                </div>
            </div>

            <div class="row">
            <?php
                 foreach($posts as $p)
                 {
                    $vu = url('post')."?xf=".$p['slug'];
               ?>
                 <!--
                  <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start --
                    <div class="post-item wow fadeInUp">
                        <!-- Post Featured Image Start--
                        <div class="post-featured-image">
                            <a href="{{$vu}}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{$p['image']}}" alt="{{$p['title']}}">
                                </figure>
                            </a>
                        </div>
                        <!-- Post Featured Image End --

                        <!-- Post Item Body Start --
                        <div class="post-item-body">
                            <!-- Post Item Content Start --
                            <div class="post-item-content">
                                <h2><a href="{{$vu}}">{{$p['title']}}</a></h2>
                            </div>
                            <!-- Post Item Content End --

                            <!-- Post Item Readmore Button Start--
                            <div class="post-item-btn">
                                <a href="{{$vu}}" class="readmore-btn">Read more</a>
                            </div>
                            <!-- Post Item Readmore Button End--
                        </div>
                        <!-- Post Item Body End --
                    </div>
                    <!-- Post Item End --
                </div>
               <?php
                 }
               ?>
            </div>
        </div>
    </div>