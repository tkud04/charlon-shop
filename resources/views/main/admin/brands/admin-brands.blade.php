 <?php
$void = 'javascript:void(0)';
$title = "Brands";
$mode = "admin";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop



@section('content')

@include('components.generic-banner',[
   'title' => "Brands",
   'description' => "Here you can view and manage product brands"
  ])
  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary mb-2" href="{{url('add-brand')}}">+ Add Brand</a>
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
                   $v = (isset($brands) && count($brands) > 0);

                   if($v)
                   {
                     foreach($brands as $c)
                     {
                        $sid = $c['id'];
                       $ru = url('remove-brand')."?xf=".$sid;
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
                        <a href="#" id="rb-{{$sid}}-btn" onclick="confirmRemoveBrand({xf:'{{$sid}}'}); return false;" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                        @include('components.form-loading',['id' => 'rb-'.$sid])
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
const confirmRemoveBrand = (payload={xf:''}) => {
    let sid = `rb-${$('#xx').val()}`;
    toggleFormButton({id: sid,mode: 'hide'});
          confirmAction(payload, 
              (p) => {
           rb(p,
           (data) => {
                 let sid = `rb-${$('#xx').val()}`;
                   toggleFormButton({id: sid,mode: 'show'});

                   if(data.status === 'ok'){         
                    alert('Brand removed!');
                    window.location.reload();            
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    let sid = `rb-${$('#xx').val()}`;
                    toggleFormButton({id: sid,mode: 'show'});
                    alert(`Failed to remove brand: ${err.toString()}`);
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