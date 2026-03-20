<?php
$void = 'javascript:void(0)';
$title = $u['username'];
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

   const confirmUpdateUser = (pid,op) => {
    console.log({pid,op});
    
          confirmAction(`${pid}|${op}`, 
              (dt) => {
              const dtArr = dt.split('|');
           updateUser({xf:dtArr[0],op: dtArr[1]},
                    () => {
                         alert('User status updated!');
                        window.location = 'user?xf=' + dtArr[0];
                    },
                    (err) => {
                         alert('Failed to update user: ',err);
                    }
                 )
         })
      
      }



   const confirmUpdateWithdrawal = (payload={xf:'',s:''}) => {
          confirmAction(payload, 
              (p) => {
           updateWithdrawal(p,
                    () => {
                         alert('Withdrawal updated!');
                         window.location = 'user?xf=' + dtArr[0];
                    },
                    (err) => {
                         alert('Failed to update withdrawal: ',err);
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

<?php
$uid = $u['id'];
$temp = $u['status'] === 'ok' ? 'disable' : 'enable';
$ru = ucwords($temp)." this user";
?>

<div class="row">
    <div class="col-md-6 p-2">
        <div class="safebets-card">
           <h3>Profile Information</h3>
           <p>Name: <b>{{$u['fname']}} {{$u['lname']}}</b></p>
           <p>Username: <b>{{$u['username']}}</b></p>
           <p>Email: <b>{{$u['email']}}</b></p>
        </div>
    </div>
    <div class="col-md-6 p-2">
        <div class="safebets-card">
           <h3>Quick Links</h3>
           <p><a href="#" onclick="confirmUpdateUser('{{$uid}}','{{$temp}}'); return false;" class="button gray"><i class="fa fa-cog"></i> {{$ru}}</a></p>
        </div>
    </div>
    <div class="col-md-12 p-2">
       <div class="safebets-card">
          <h3>Purchases</h3>
          <div class="">
            <table class="table table-hover safebets-table">
				<thead>
				  <tr>
                  <th>Purchase</th>
					<th>Actions</th>
				  </tr>
				</thead>
            <tbody>
				<?php
                  $v = (isset($purchases) && count($purchases) > 0);

                  if($v)
                  {
                    foreach($purchases as $purchase)
                    {
                      $ticket = $purchase['ticket'];
                      $predictions = $ticket['predictions'];
                      $codes = $ticket['codes'];

                       $ticketStatus =  "expired";
                       if($ticket['status'] === "ok") $ticketStatus = "active";
                       else if($ticket['status'] === "lost") $ticketStatus = "lost";
                       else if($ticket['status'] === "won") $ticketStatus = "won";
        ?>
        <tr>
				    <td>
              <ul>
                <li>1st match kickoff: <b>{{$ticket['kickoff_date_formatted']}} | {{$ticket['kickoff']}}</b></li>
               @if(count($codes) > 0)
                 @foreach($codes as $ccc)
                  @if(strlen($ccc['site']['name']) > 0 && strlen($ccc['code']) > 0)
                    <li>{{ $ccc['site']['name'] }} booking code: <b>{{$ccc['code']}}</b></li>
                  @else
                  <p>Booking code unavailable</p>
                  @endif
                  @endforeach
                @endif
               
              </ul>
              

              <div class="row">
                
               <?php
                    foreach($predictions as $p)
                    {
                       
                 ?>
				          <div class="col-md-4">
				           @include('components.prediction-box',[
                     'data' => $p,
                    ])
                  </div>
            <?php
                 }
                ?> 
            </div>
            </td>
            <td> <p>Status: <b>{{strtoupper($ticketStatus)}}</b></p>  </td>
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
    <div class="col-md-12 p-2">
       <div class="safebets-card">
          <h3>Wihdrawals</h3>
          <div class="">
            <table class="table table-hover safebets-table">
				<thead>
				  <tr>
                  <th>Wihdrawal Request</th>
					<th>Actions</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                 $v = (isset($withdrawals) && count($withdrawals) > 0);
                  if($v)
                  {
                    foreach($withdrawals as $withdrawal)
                    {
                        $wid = $withdrawal['id'];
                        $temp = 'withdrawal';
					  $wu = url($temp)."?xf={$wid}&status=w";
					  $lu = url($temp)."?xf={$wid}&status=l";
                      $u = $withdrawal['user'];

                    
                     $status =  "expired";
                     if($withdrawal['status'] === "ok") $status = "pending";
                     else if($withdrawal['status'] === "processed") $status = "processed";
                     else if($withdrawal['status'] === "cancelled") $status = "cancelled";
                      
                 ?>
				  <tr>
					<td>
                     <p>Email: <b>{{$u['email']}}</b></p>         
                     <p>Amount: <b>{{$withdrawal['amount']}}</b></p>         
                     <p>Whatsapp #: <b>{{$withdrawal['whatsapp_phone']}}</b></p>         
                     <p>Date requested: <b>{{$withdrawal['date']}}</b></p>   
                     <p>Status: <b>{{strtoupper($status)}}</b></p>      
                    </td>
					<td>
                        @if($status === 'active')
                       <p> <a href="#" onclick="confirmUpdatePurchase({xf:'{{$pid}}',s: 'w'}); return false;" class="button gray"><i class="fa fa-check"></i> Mark as processed</a></p>
                       <p> <a href="#" onclick="confirmUpdatePurchase({xf:'{{$pid}}',s: 'l'}); return false;" class="button gray"><i class="fa fa-times"></i> Mark as refunded</a></p>
                       @endif
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