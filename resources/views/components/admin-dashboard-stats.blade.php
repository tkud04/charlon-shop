<?php
$t_m = isset($total_members) ? $total_members : 0;
$t_e = isset($total_events) ? $total_events : 0;
$t_r = isset($total_requests) ? $total_requests : 0;
?>

<div class="row" style="padding: 10px; width: 80%; margin-left:10%;">
    <div class="col-md-4 my-4 py-4" style="margin-top: 10px; background-color: #000;">
      <p  style='font-size: 40px; font-weight: 700;' class='text-white'>{{$t_m}}</p>
      <p  style='font-size: 20px; font-weight: 700;' class='text-white'>Total<br> Members</p>
    </div>
    <div class="col-md-4 my-4 py-4" style="margin-top: 10px;background-color: #c4ee18;">
    <p  style='font-size: 40px; font-weight: 700; color: #000;'>{{$t_e}}</p>
    <p  style='font-size: 20px; font-weight: 700; color: #000;'>Total<br>Events</p>
    </div>
    <div class="col-md-4 my-4 py-4" style="margin-top: 10px;background-color: #000;">
    <p  style='font-size: 40px; font-weight: 700; color: #000;' class='text-white'>{{$t_r}}</p>
    <p  style='font-size: 20px; font-weight: 700; color: #000;' class='text-white'>Total<br>Requests</p>
    </div>

    </div>