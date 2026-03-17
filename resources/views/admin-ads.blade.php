<?php
$void = 'javascript:void(0)';
$title = "Ads";
$mode = "admin";
?>
@extends('dashboard_layout')

@section('title',$title)

@section('dashboard-styles')
<link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
<script src="lib/datatables/datatables.min.js"></script>

<script>

   const confirmRemoveAd= (pid) => {
          confirmAction(pid, 
              (xf) => {
           removeAd({xf},
                    () => {
                         alert('Ad removed!');
                        window.location = 'ads';
                    },
                    (err) => {
                         alert('Failed to remove ad: ',err);
                    }
                 )
         })
      
      }

  
  $(() => {
        let tables = $('.safebets-table');
        tables?.dataTable();
    }
  );
</script>
@stop

@section('dashboard-content')
@include('components.scrolling-ads',['data' => $ads ])

<div class="my-4">
<a href="{{url('add-ad')}}">+ Add Ad</a>
</div>
<div class="">
            <table class="table table-hover safebets-table">
				<thead>
				  <tr>
					<th>Ad</th>
					<th>Status</th>
					<th>Date Added</th>
					<th>Actions</th>
				  </tr>
				</thead>
				<tbody>
				<?php
        $v = (isset($ads) && count($ads) > 0);

                  if($v)
                  {
                    foreach($ads as $a)
                    {
                       $pid = $a['id'];
                       $cc = [];
                      	$temp = 'remove-ad';
						            $ru = url($temp)."?xf={$pid}";
                      
                 ?>
				  <tr>
					<td>
                        {{$a['name']}} | {{$a['value']}} 
                        <img src="images/ads/{{$a['image']}}" style="width: 50px; height: 50px;"/>
                        
                    </td>
					<td>{{strtoupper($a['status'])}}</td>
					<td>{{$a['date']}}</td>
					<td>
                        <a href="#" onclick="confirmRemoveAd('{{$pid}}'); return false;" class="button gray"><i class="fa fa-trash"></i> </a>
                    </td>
				  </tr>
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
            </div>
@stop