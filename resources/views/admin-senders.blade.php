<?php
$void = 'javascript:void(0)';
$title = "Senders";
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

   const confirmRemoveSender = (payload={xf:''}) => {
          confirmAction(payload, 
              (p) => {
           removeSender(p,
                    () => {
                         alert('Sender removed!');
                        window.location = 'senders';
                    },
                    (err) => {
                         alert('Failed to remove senders: ',err);
                    }
                 )
         })
      
      }


      const confirmUpdateSender = (payload={xf:''}) => {
          confirmAction(payload, 
              (p) => {
           updateSender(p,
                    () => {
                         alert('Sender updated!');
                        window.location = 'senders';
                    },
                    (err) => {
                         alert('Failed to update sender: ',err);
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
   'title' => "SMTP Settings",
   'description' => "Here you can view and manage site SMTP (email) settings"
  ])


  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
<div class="col-md-12 my-4">
<a class="btn btn-primary" href="{{url('add-sender')}}">+ Add Sender</a>
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
					<th>Info</th>
					<th>Current?</th>
					<th>Date Added</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  $v = (isset($senders) && count($senders) > 0);

                   if($v)
                   {
                    foreach($senders as $s)
                     {
                        $sid = $s['id'];
                       $ru = url('remove-sender')."?xf=".$sid;
                 ?>
				  <tr>
				     <td> 
                <p>SMTP server: {{$s['ss']}}</p>
                <p>SMTP username: {{$s['se']}}</p>
                <p>Status: {{strtoupper($s['status'])}}</p>
             </td>
				     <td>{{($s['current'])}}</td>
             <td>
             <p>Date added: {{strtoupper($s['date'])}}</p>
             </td>
                    <td>
                        <a href="#" id="rs-{{$sid}}-btn" onclick="confirmRemoveSender({xf:'{{$sid}}'}); return false;" class="btn btn-danger"><i class="fa-light fa-trash"></i></a>
                        <a href="#" id="us-{{$sid}}-btn" onclick="confirmUpdateSender({xf:'{{$sid}}'}); return false;" class="btn btn-info"><i class="fa-light fa-paper-plane"></i></a>
                        @include('components.form-loading',['id' => 'us-'.$sid])
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