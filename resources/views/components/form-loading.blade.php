<?php
$idd = isset($id) ? $id : '';
$classs = isset($class) ? $class."-loading " : '';
$msg = isset($message) ? $message : 'Processing';
if(isset($noMsg) && $noMsg) $msg = "";
$ss = isset($size) ? $size: 50;
?>

<div id="{{$idd}}-loading" class="{{$classs}}form-loading" style='display: flex; flex-direction: row; align-items:center;'>
   <p class="">{{$msg}}</p>
   <img src="images/loading.gif" style="width: {{$ss}}px; height: {{$ss}}px; margin-left: 5px;"/>
</div>