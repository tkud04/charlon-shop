 <?php
$void = 'javascript:void(0)';
$title = "Categories";
$mode = "admin";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop



@section('content')

@include('components.generic-banner',[
   'title' => "Categories",
   'description' => "Here you can view and manage product categories"
  ])
  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary mb-2" href="{{url('add-category')}}">+ Add Category</a>
</div>
<div class="col-md-4 mt-4">
     <div class="row">
        <div class="col-md-12 my-4">
           @include('components.admin-sidebar')
        </div>
     </div>
  </div>
  <div class="col-md-8" style="height: 400px; overflow:scroll;">

        <div class="">
              <table class="table table-hover ukpor-table">
				<thead>
				  <tr>
					<th>Category</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                   $v = (isset($categories) && count($categories) > 0);

                   if($v)
                   {
                     foreach($categories as $c)
                     {
                        $sid = $c['id'];
                       $ru = url('remove-category')."?xf=".$sid;
                       $img = $c['img'] ? $c['img'] : "img/unkwown.png";
                 ?>
				  <tr>
				     <td>
                        <div class="row">
                            <div class="col-md-8">
                              <p>Title: {{ucwords($c['title'])}} </p>  
                              <p>Slug: {{$c['slug']}} </p>
                            </div>
                            <div class="col-md-4">
                               <img src="{{$img}}" class="img-responsive" style="width: 100px; height: 100px; border-radius: 10px;" alt="{{$title}}">
                            </div>
                        </div>
                        
                    </td>
                    <td>
                        <a href="#" id="rc-{{$sid}}-btn" onclick="confirmRemoveCategory({xf:'{{$sid}}'}); return false;" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                        @include('components.form-loading',['id' => 'rc-'.$sid])
                    </td>
				  </tr>
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
            </div>
            </div>
            </div>
            <input type="hidden" id="xx" value=""/>
  </div>
  </div>
@stop


@section('scripts')
<script src="lib/datatables/datatables.min.js"></script>

<script>
const confirmRemoveCategory = (payload={xf:''}) => {
    let sid = `rc-${$('#xx').val()}`;
    toggleFormButton({id: sid,mode: 'hide'});
          confirmAction(payload, 
              (p) => {
           rc(p,
           (data) => {
                 let sid = `rc-${$('#xx').val()}`;
                   toggleFormButton({id: sid,mode: 'show'});

                   if(data.status === 'ok'){         
                    alert('Category removed!');
                    window.location.reload();            
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    let sid = `rc-${$('#xx').val()}`;
                    toggleFormButton({id: sid,mode: 'show'});
                    alert(`Failed to remove category: ${err.toString()}`);
                }
                 )
         });
      
      }

  $(() => {
        let tables = $('.ukpor-table');
        tables?.dataTable();

        hideFormValidations();
    }
  );
</script>
@stop