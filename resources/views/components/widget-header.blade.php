<?php
$t = isset($title) ? $title : '';
$s = isset($subtitle) ? $subtitle : '';
$s2 = isset($style) ? ' style="'.$style.'"' : '';
?>

<div class="container">
   <div class="row"{!!$s2!!}>
      <div class="col-md-12">
           <h1 class="title">{{$t}}</h1>
           <p class="title-desc">{{$s}}</p>
       </div>
    </div>
</div>