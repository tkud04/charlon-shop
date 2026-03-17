<?php
$void = 'javascript:void(0)';
$title = "Add Product Category";
?>
@extends('layout')

@section('title',$title)

@section('bodyClass','border_style html_oh')

@section('content')
<div class="row">
    <div class="col-md-12">
    <h3 style="margin-left: 10px;">Add New Product Category</h3>
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
             <input class='form-control' id="slug" type="text" placeholder="Product nickname" required="required">
            @include('components.form-validation',['id' => 'slug'])
         </div>
       </div>
       
    <div class="col-md-12">
    @include('components.button',['id' => 'add-category','title' => 'Submit'])

     @include('components.form-loading',['id' => 'add-category'])
    </div>
    </form>
    </div>
</div>
@stop

@section('scripts')
<script>
  $(() => {
    $('#add-category-btn').click((e) => {
      e.preventDefault();
     
      const slug = $('#slug').val(), title = $('#pname').val();

       const v = slug.length < 1 || title.length < 1;

      
       if(v){
         if(slug.length < 1) $('#slug-validation').fadeIn();
         if(title.length < 1) $('#pname-validation').fadeIn();
       }
       else{
        toggleFormButton({id: 'add-category',mode: 'hide'});

         const p = {
          title,
           slug
         };

         addProductCategory(
                p,
                (data) => {
                   toggleFormButton({id: 'add-category',mode: 'show'});

                   if(data.status !== 'error'){
                     alert('Category added!');
                      window.location = 'dashboard';
                   }
                   else{
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-category',mode: 'show'});
                    alert(`Failed to add category: ${err}`)
                }
            );
       }
    });
  });
</script>
@stop