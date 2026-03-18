<?php
$i = isset($img) ? $img : '';
$t = isset($title) ? $title : 'My Category';
$d = isset($description) ? $description : '';
?>
<div id="category-header">
<div class="container">
    <div class="col-2">
        <div class="category-image"><img src="{{$i}}" alt="{{$t}}" class="img-responsive"></div>
    </div>
    <div class="col-2 last">
        <div class="category-title">
            <h2>{{$t}}</h2>
            <p>{!! $d !!}</p>
        </div>
    </div>
</div>
</div>