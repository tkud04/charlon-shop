<?php
$void = 'javascript:void(0)';
$title = "Plugins";
$mode = "admin";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('scripts')
<script src="lib/datatables/datatables.min.js"></script>

<script>

   const confirmRemovePlugin = (payload={xf:''}) => {
          confirmAction(payload, 
              (p) => {
           removePlugin({p},
                    () => {
                         alert('Plugin removed!');
                        window.location = 'plugins';
                    },
                    (err) => {
                         alert('Failed to remove plugin: ',err);
                    }
                 )
         })
      
      }

  
  $(() => {
        let tables = $('.ukpor-table');
        tables?.dataTable();
        hideFormValidations();
    }
  );
</script>
@stop

@section('content')
@include('components.generic-banner',[
   'title' => "Plugins",
   'description' => "Here you can view and manage site plugins"
  ])


  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary" href="{{url('add-plugin')}}">+ Add Plugin</a>
</div>
<div class="col-md-4">
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
					<th>Title</th>
					<th>Status</th>
					<th>Date Added</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  $v = (isset($plugins) && count($plugins) > 0);

                  if($v)
                  {
                    foreach($plugins as $p)
                     {
                      $pid = $p['id'];
                      $cc = [];
                      $ru = url('remove-plugin')."?xf={$pid}";
                 ?>
				  <tr>
          <td>{{$p['name']}}</td>
					<td>{{strtoupper($p['status'])}}</td>
					<td>{{$p['date']}}</td>
                    <td>
                        <a href="#" id="rp-{{$pid}}-btn" onclick="confirmRemovePlugin({xf:'{{$pid}}'}); return false;" class="btn btn-danger"><i class="fa-light fa-trash"></i></a>
                        @include('components.form-loading',['id' => 'rp-'.$pid])
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