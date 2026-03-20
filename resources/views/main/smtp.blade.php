<?php
$void = 'javascript:void(0)';
$title = "SMTP Settings";
?>
@extends('layout')

@section('title',$title)

@section('styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop


@section('content')
<div class="container-fluid">
    
   <div class="row">
   <div class="col-md-12 my-4">
<a class="btn btn-primary" href="{{url('add-smtp')}}">+ Add Sender</a>
</div>
      <div class="col-12" style="height: 400px; overflow:scroll;">
         <h3 class="text-center">SMTP Senders List</h3>

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
</div>
@stop

@section('scripts')
<script src="lib/datatables/datatables.min.js"></script>
<script src="lib/ckeditor/ckeditor.js"></script>
<script>  


const confirmRemoveSender = (payload={xf:''}) => {
          confirmAction(payload, 
              (p) => {
           removeSender(p,
                    () => {
                         alert('Sender removed!');
                        window.location = 'smtp';
                    },
                    (err) => {
                         alert('Failed to remove sender: ',err);
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
                        window.location = 'smtp';
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


});
</script>
@stop


