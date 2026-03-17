<?php
$text = (isset($title) && strlen($title) > 0) ? $title : "Charlon Shop";
$d = (isset($description) && strlen($description) > 0) ? $description : "Buy your favorite items here";
?>

<div id="breadcrumb-container">
   <div class="container">
      <ul class="breadcrumb">
         <li><a href="{{url('/')}}">Home</a></li>
         <li class="active">{{$text}}</li>
      </ul>
   </div>
</div>

<div class="container">
   <header class="content-title">
      <h1 class="title">{{$text}}</h1>
      <p class="title-desc">{{$d}}</p>
   </header>
</div>
