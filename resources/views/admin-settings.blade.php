 <?php
$void = 'javascript:void(0)';
$title = "Settings";
$mode = "admin";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop



@section('content')

@include('components.generic-banner',[
   'title' => "Settings",
   'description' => "Here you can view and manage site settings"
  ])
  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary" href="{{url('add-setting')}}">+ Add Setting</a>
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
					<th>Setting</th>
					<th>Value</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                   $v = (isset($settings) && count($settings) > 0);

                   if($v)
                   {
                     foreach($settings as $setting)
                     {
                        $sid = $setting['id'];
                       $ru = url('remove-setting')."?xf=".$sid;
                 ?>
				  <tr>
				     <td> <p>Title: {{ucwords($setting['name'])}} </p>   </td>
				     <td>  <p>Value: {{ucwords($setting['value'])}} </p> </td>
                    <td>
                        <a href="#" id="rs-{{$sid}}-btn" onclick="confirmRemoveSetting({xf:'{{$sid}}'}); return false;" class="btn btn-danger"><i class="fa-light fa-trash"></i></a>
                        @include('components.form-loading',['id' => 'rs-'.$sid])
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
const confirmRemoveSetting = (payload={xf:''}) => {
          $('#xx').val(payload.xf);
          confirmAction(payload, 
              (p) => {
           removeSetting(p,
           (data) => {
                 let sid = `rs-${$('#xx').val()}`;
                   toggleFormButton({id: sid,mode: 'show'});

                   if(data.status === 'ok'){
                     
                    
alert('Setting removed!');
                    window.location.reload();

                    
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    let sid = `rs-${$('#xx').val()}`;
                    toggleFormButton({id: sid,mode: 'show'});
                    alert(`Failed to remove setting: ${err.toString()}`);
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