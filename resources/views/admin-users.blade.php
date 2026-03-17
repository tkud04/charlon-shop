<?php
$void = 'javascript:void(0)';
$title = "Users";
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

   const confirmUpdateUser = (pid) => {
          confirmAction(pid, 
              (xf) => {
           updateUser(xf,
                    () => {
                         alert('User status updated!')
                        window.location = 'clubs'
                    },
                    (err) => {
                         alert('Failed to remove club: ',err)
                    }
                 )
         })
      
      }

  
  $(document).ready(
    () => {
        let tables = $('.safebets-table');
        console.log('tables: ',tables);
        tables?.dataTable();
    }
  );
</script>
@stop

@section('dashboard-content')
@include('components.scrolling-ads',['data' => $ads ])
<div class="">
            <table class="table table-hover safebets-table">
				<thead>
				  <tr>
					<th>Info</th>
					<th>Role</th>
					<th>Status</th>
					<th>Date Added</th>
					<th>Actions</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  if(isset($users) && count($users) > 0)
                  {
                    foreach($users as $u)
                    {
                       $uid = $u['id'];
						$temp = $u['status'] === 'ok' ?  'disable-user' : 'enable-user';
						$ru = url($temp)."?xf={$uid}";
                     $vu = url('user')."?xf={$uid}";
                 ?>
				  <tr>
					<td>
                        <ul>
                            <li class="p-2">{{$u['fname']}} {{$u['lname']}} <a href='{{$vu}}' class='btn btn-info'>View more</a></li>
                            <li class="p-2">Username: {{$u['username']}}</li>
                            <li class="p-2">Email: {{$u['email']}}</li>
                            <li class="p-2">Gender: {{$u['gender']}}</li>
                        </ul>
                      <p></p>
                      <p></p>
                    </td>
					<td> <p style="font-weight: bold;">{{strtoupper($u['role'])}}</p></td>
					<td> <p style="font-weight: bold;">{{strtoupper($u['status'])}}</p></td>
					<td>{{$u['date']}}</td>
					<td><a href="#" onclick="confirmUpdateUser('{{$uid}}'); return false;" class="button gray"><i class="fa fa-cog"></i> </a></td>
				  </tr>
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
            </div>
@stop