<?php
$void = 'javascript:void(0)';
$title = "Add Product";
?>
@extends('layout')

@section('title',$title)

@section('bodyClass','border_style html_oh')

@section('content')
<div class="row">
    <div class="col-md-12">
    <h3 style="margin-left: 10px;">Add New Product</h3>
    <form class='form'>
    <div class="row">
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Name<span style='color: red;'>*</span></h6>
             <input class='form-control' id="pname" type="text" placeholder="Product name" required="required">
            @include('components.form-validation',['id' => 'pname'])
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Slug (catchy nickname)<span style='color: red;'>*</span></h6>
             <input class='form-control' id="slug" type="text" placeholder="Product nickname" required="required" disabled>
            @include('components.form-validation',['id' => 'slug'])
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Category<span style='color: red;'>*</span></h6>
             <select class='form-control' id="pcat" required="required">
              <option value="none">Select an option</option>
              <?php
                if(count($categories) > 0)
                {
                   foreach($categories as $c)
                    {
              ?>
                 <option value="{{$c['slug']}}">{{$c['title']}}</option>
              <?php
                    }
                }
              ?>
             </select>
            @include('components.form-validation',['id' => 'pcat'])
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Image URL<span style='color: red;'>*</span></h6>
             <input class='form-control' id="image" type="text" placeholder="Image URL" required="required">
            @include('components.form-validation',['id' => 'image'])
         </div>
       </div>
       <div class="col-md-12">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Description</h6>
             <textarea class='form-control' id="description" rows="8" placeholder="Product description" required="required"></textarea>
            @include('components.form-validation',['id' => 'description'])
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Price(&#8358;)<span style='color: red;'>*</span></h6>
             <input class='form-control' id="price" type="number" placeholder="Product price" required="required">
            @include('components.form-validation',['id' => 'price'])
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Status<span style='color: red;'>*</span></h6>
             <select class='form-control' id="pstatus" required="required">
              <option value="none">Select an option</option>
              <?php
                if(count($statuses) > 0)
                {
                   foreach($statuses as $st)
                    {
              ?>
                 <option value="{{$st['value']}}">{{$st['label']}}</option>
              <?php
                    }
                }
              ?>
             </select>
             @include('components.form-validation',['id' => 'pstatus'])
         </div>
       </div>
    </div>
    <div class="col-md-12">
    @include('components.button',['id' => 'add-product','title' => 'Submit'])

     @include('components.form-loading',['id' => 'add-product'])
    </div>
    </form>
    </div>
</div>
@stop

@section('scripts')
<script>
  $(() => {
    $('#pname').change(() => {
      let a1 = $('#pname').val().toLowerCase().split(' '), ret = '';

      if(a1.length <= 1){
        ret = a1;
      }
      else{
        ret = a1[0];
        for(let i = 1; i < a1.length; i++) ret += `-${a1[i]}`;
      }

      $('#slug').val(ret);
    });

    $('#add-product-btn').click((e) => {
      e.preventDefault();
     
      const slug = $('#slug').val(), category = $('#pcat').val(), title = $('#pname').val(), image = $('#image').val(),
       description = $('#description').val(), price = $('#price').val(), status = $('#pstatus').val();

       const v = slug.length < 1 || category === 'none' || title.length < 1 || image.length < 1 ||
                 parseFloat(price) < 1 || status === 'none';


       if(v){
         if(slug.length < 1) $('#slug-validation').fadeIn();
         if(category === 'none' ) $('#pcat-validation').fadeIn();
         if(title.length < 1) $('#pname-validation').fadeIn();
         if(image.length < 1) $('#image-validation').fadeIn();
         if(parseFloat(price) < 1) $('#price-validation').fadeIn();
        if(status === 'none') $('#pstatus-validation').fadeIn();
       }
       else{
        toggleFormButton({id: 'add-product',mode: 'hide'});

         const p = {
          title,
          category,
          image,
           price,
           description,
           slug,
           sstatus: status
         };

         addProduct(
                p,
                (data) => {
                   toggleFormButton({id: 'add-product',mode: 'show'});

                   if(data.status === 'ok'){
                     alert('Product added!');
                      window.location = 'products';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-product',mode: 'show'});
                    alert(`Failed to add product: ${err}`)
                }
            );
       }
    });
  });
</script>
@stop