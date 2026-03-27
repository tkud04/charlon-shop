<?php
$testData = [];
$items = (isset($data) && count($data) > 0) ? $data : $testData;
?>
<div class="container">		
<div class="row">
<div class="col-md-12">
<div id="bxCarousel" class="carousel slide carousel-fade">
    <div class="carousel-inner">
        <?php
          for($i = 0; $i < count($items); $i++)
          {
            $p = $items[$i];
            $img = isset($p['images'][0]) ? $p['images'][0]['url'] : '';
            $title = substr($p['title'],0,20)."...";
            $price = number_format($p['newPrice'],2);
            $ss = $i === 0 ? " active" : "";
        ?>
         <div class="carousel-item"{{$ss}}>
            <div class="card" style="width: 18rem;">
                 <img src="{{$img}}" class="card-img-top" alt="{{$title}}">
                 <div class="card-body">
                    <h3 class="card-title">{{$title}}</h3>
                    <p class="card-text">${{$price}}</p>
                 </div>
             </div>
         </div>
         <?php
          }
         ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bxCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bxCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
</div>
</div>
