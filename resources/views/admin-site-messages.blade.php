<?php
$void = 'javascript:void(0)';
$title = "Site Messages";
$mode = "admin";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop



@section('content')


<!--
<div class="my-4">
<a href="{{url('add-s')}}">+ Add Setting</a>
</div>
-->

@include('components.generic-banner',[
   'title' => "Site Messages",
   'description' => "Here you can view a list of messages sent from the Contact Us form"
  ])
  <div class=" tp-portfolio-area pb-10">
  <div class="container">
<div class="row">
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
					<th>Sender</th>
					<th>Message</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  $v = (isset($data) && count($data) > 0);

                  if($v)
                  {
                    foreach($data as $d)
                    {
                       $sid = $d['id'];
                       $ru = url('remove-site-message')."?xf=".$sid;
                       $eu = "mailto:".$d['email'];
                 ?>
				  <tr>
				     <td> 
                        <p>{{ucwords($d['name'])}}  <a href="{{$eu}}" class="btn btn-primary">{{$d['email']}}</a></p>  
                    </td>
				     <td> 
                        <h4>{{$d['subject']}}</h4>
                        <p>{{$d['body']}}</p>  
                    </td>
                    <td>
                        <a href="#" id="rsm-{{$sid}}-btn" onclick="confirmRemoveMessage({xf:'{{$sid}}'}); return false;" class="btn btn-danger"><i class="fa-light fa-trash"></i>  </a>
                        @include('components.form-loading',['id' => 'rsm-'.$sid])
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
const confirmRemoveMessage = (payload={xf:''}) => {
          $('#xx').val(payload.xf);
          confirmAction(payload, 
              (p) => {
           rsm(p,
           (data) => {
                 let sid = `rsm-${$('#xx').val()}`;
                   toggleFormButton({id: sid,mode: 'show'});

                   if(data.status === 'ok'){
                     
                    
                    showCustomAlert({
                        title: 'Message Removed!',
                        text: '',
                        icon: 'success'
                    })
                    window.location.reload();

                    
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    let sid = `rsm-${$('#xx').val()}`;
                    toggleFormButton({id: sid,mode: 'show'});
                    alert(`Failed to remove site message: ${err.toString()}`);
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