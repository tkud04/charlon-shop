<?php
$void = 'javascript:void(0)';
$title = "Add Category";
$mode = "admin";
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
             <input class='form-control' id="pname" type="text" placeholder="Category name" required="required">
            @include('components.form-validation',['id' => 'pname'])
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
             <h6 class='control-label'>Slug (catchy nickname)<span style='color: red;'>*</span></h6>
             <input class='form-control' id="slug" type="text" placeholder="Category slug" required="required">
            @include('components.form-validation',['id' => 'slug'])
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group" style="padding: 10px;">
         <h6 class='control-label'>Image <span style='color: red;'>*</span></h6>
           <input type="file" id="ac-pf">
           @include('components.form-validation',['id' => 'ac-pf'])
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
    hideFormValidations();
    $('#pname').change(() => {
       const ret = sluggify($('#pname').val());
       $('#slug').val(ret);
    });

    $('#add-category-btn').click((e) => {
      e.preventDefault();
      hideFormValidations();
      const slug = $('#slug').val(), title = $('#pname').val(), pf = document.querySelector('#ac-pf').files.item(0);

       const v = slug.length < 1 || title.length < 1 || pf === null;

      
       if(v){
         if(slug.length < 1) $('#slug-validation').fadeIn();
         if(title.length < 1) $('#pname-validation').fadeIn();
         if(pf === null) $('#ac-pf-validation').fadeIn();
       }
       else{
        toggleFormButton({id: 'add-category',mode: 'hide'});

        let p = new FormData();
      p.append('title',title);
      p.append('slug',slug);
      p.append('pf',pf);

         ac(
                p,
                (data) => {
                   toggleFormButton({id: 'add-category',mode: 'show'});

                   if(data.status !== 'error'){
                     alert('Category added!');
                      window.location = 'categories';
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