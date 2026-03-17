<?php
$t_b = isset($total_badges) ? $total_badges : '100%';
$t_p = isset($tier) ? $t : 1;
?>

<div class="row" style="padding: 10px;">
    <div class="col-md-3"></div>
    <div class="col-md-3 my-4 py-4" style="margin-top: 10px; background-color: #000;">
      <p  style='font-size: 40px; font-weight: 700;' class='text-white'>{{$t_b}}</p>
      <p  style='font-size: 20px; font-weight: 700;' class='text-white'>Verified</p>
    </div>
    <div class="col-md-3 my-4 py-4" style="margin-top: 10px;background-color: #c4ee18;">
    <p  style='font-size: 40px; font-weight: 700; color: #000;'>{{$t_p}}</p>
    <p  style='font-size: 20px; font-weight: 700; color: #000;'>Current<br>Tier</p>
    </div>
    <div class="col-md-3"></div>
    </div>