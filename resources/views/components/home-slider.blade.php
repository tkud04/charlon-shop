
<?php
$items = (isset($data) && count($data) > 0) ? $data : [];
?>
<div class="container">		
   <div class="row">
      <div class="col-md-12">
      <?php
       if(count($items) > 0)
       {
      ?>
      <section class="cd-hero js-cd-hero js-cd-autoplay">
         <ul class="cd-hero__slider">
             <?php
                $ctr = count($items) >= 4 ? 4 : count($items);
                $imgPos = 'left';
                for($x = 0; $x < $ctr - 1; $x++)
                { 
                  $i = $items[$x];
                  $title = $i['title'].substr(0,20);
                  $img = isset($i['images'][0]) ? $i['images'][0]['url'] : '';
                  $imgHtml = "<div class='cd-hero__content cd-hero__content--half-width cd-hero__content--img'>";
					        $imgHtml .= "<img src='".$img."' alt='".$title."'>";
				          $imgHtml .= "</div>";
                  $imgPos = $imgPos === 'left' ? 'right' : 'left';
                  $brand = $i['brand']['title'];
             ?>
                @if($imgPos === 'left')
                  {!! $imgHtml !!}
                @endif

                <div class="cd-hero__content cd-hero__content--half-width">
				        	<h2>{{$title}}</h2>
				        	<p>{{$i['category']['title']}}</p>
					        <a href="#0" class="cd-hero__btn">Start</a>
					        <a href="#0" class="cd-hero__btn cd-hero__btn--secondary">Learn More</a>
				        </div> <!-- .cd-hero__content -->

                @if($imgPos === 'right')
                    {!! $imgHtml !!}
                @endif
             <?php
                }
             ?>
         </ul>
         <div class="cd-hero__nav js-cd-nav">
			      <nav>
			      	<span class="cd-hero__marker cd-hero__marker--item-1 js-cd-marker"></span>
				       
			        <ul>
                 <?php
                 for($x = 0; $x < $ctr; ++$x)
                 {
                  $ss = $x === 0 ? "class='cd-selected'" : '';
                 ?>
					          <li{{$ss}}><a href="#0">{{$brand}}</a></li>
                <?php
                 }
                ?>
				     </ul>
		      	</nav> 
		     </div> <!-- .cd-hero__nav -->
      </section>
      <?php
       }
      ?>
      </div>
   </div>
</div>
