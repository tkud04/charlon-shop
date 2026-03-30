<?php
$void = 'javascript:void(0)';
$title = "Welcome";
?>
@extends('layout')

@section('title',$title)


@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <h1 class="title">HOT Products</h1>
        <p class="title-desc">Best sellers for {{date("M Y")}}</p>
    </div>
</div>
</div>

@include('components.home-slider',[
    'data' => $bxProducts
])

<div class="xlg-margin"></div>
<div class="hero-unit">
    <h2>Welcome to Venedor!</h2>
    <p>Venedor a modern and laconic theme based on Bootstrap's 12 column 1200px responsive grid system.</p>
    <span class="small-bottom-border big"></span>
</div>

@stop





@section('scripts')
<script>
    let slideCtr = 0;
    const slideTotal = {{count($bxProducts)}};

    const accc = (pid) => {
        console.log('slug captured: ',pid);
        const cartPayload = {
                    q: 1,
                    xf: pid
                };

                toggleFormButton({id: 'index-cart',mode: 'hide'});
               atc(
            cartPayload,
            (data) => {
                   toggleFormButton({id: 'index-cart',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Added!');
                    window.location = 'cart';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'index-cart',mode: 'show'});
                    alert(`Failed to add to cart: ${err}`);
                }
            );
    }

    const prevSlider = () => {
        const prevItem = slideCtr;
        slideCtr = prevItem - 1;

      if(slideCtr < 0){
        slideCtr = 0;
      }

    
      $(`.cd`).hide();
      $(`.cd-${slideCtr}`).fadeIn();

    }

    const nextSlider = () => {
        const prevItem = slideCtr;
        slideCtr = prevItem + 1;

      if(slideCtr >= slideTotal){
        slideCtr = slideTotal - 1;
      }

      $(`.cd`).hide();
      $(`.cd-${slideCtr}`).fadeIn();

    }

    $(() => {
      hideFormValidations();
      
      //Hide other carousel items
      for(let i = 1; i < {{count($bxProducts)}}; i++)
      $(`.cd-${i}`).hide();
    });
   
</script>
@stop

