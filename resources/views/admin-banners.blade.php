<?php
$void = 'javascript:void(0)';
$title = "Banners";
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

   const confirmRemoveBanner = (pid) => {
          confirmAction(pid, 
              (xf) => {
           removeBanner({xf},
                    () => {
                         alert('Banner removed!');
                        window.location = 'banners';
                    },
                    (err) => {
                         alert('Failed to remove banner: ',err);
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
<a href="{{url('add-banner')}}">+ Add Banner</a>
</div>
<div class="">
            <table class="table table-hover safebets-table">
				<thead>
				  <tr>
					<th>Image</th>
                    <th>Banner</th>
					<th>Actions</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  if(isset($banners) && count($banners) > 0)
                  {
                    foreach($banners as $b)
                    {
                       $bid = $b['id'];
						$temp = 'remove-banner';
						$ru = url($temp)."?xf={$bid}";
                        $img = "images/banners/".$b['image'];
                      
                 ?>
				  <tr>
                  <td>
                  <p> <img src="{!! $img !!}" alt="{{$b['title']}}" style="margin-left: 5px; width: 150px; height: 200px;"/></p>
                  </td>
					<td>
                        <ul>
                            <li style="padding: 5px;">Title: {{$b['title']}}</li>
                            <li style="padding: 5px;">Subtitle: {{$b['subtitle']}}</li>
                            <li style="padding: 5px;">Points: {{$b['points']}}</li>
                            <li style="padding: 5px;">Description: {{$b['description']}}</li>
                            <li style="padding: 5px;">Button 1: Text: {{$b['btn_url_1']}}, URL: {{$b['btn_text_1']}}</li>
                            <li style="padding: 5px;">Button 2: Text: {{$b['btn_url_2']}}, URL: {{$b['btn_text_2']}}</li>
                            <li style="padding: 5px;">Date added: {{$b['date']}}</li>
                        </ul>
                       
                    </td>
					
					<td><a href="#" onclick="confirmRemoveBanner('{{$bid}}'); return false;" class="button gray"><i class="fa fa-trash"></i> </a></td>
				  </tr>
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
            </div>
@stop