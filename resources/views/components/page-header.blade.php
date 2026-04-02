<?php
$t = isset($title) ? $title : '';
$s = isset($subtitle) ? $subtitle : '';
$i = isset($img) ? $img : 'images/about-header-3.jpg';
?>
<div id="page-header" class="parallax" style="background-image: url('{{$i}}'); background-position: 50% -40px;">
    <h1>{{$t}} <span class="small-bottom-border big"></span></h1>
    <div class="md-margin"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="page-header-desc">{{$s}}</p>
            </div>
        </div>
    </div>
</div>