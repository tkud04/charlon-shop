<?php
$idd = isset($id) ? $id : '';
$classs = isset($class) ? $class."-loading " : '';
$msg = isset($message) ? $message : 'Processing';
?>

<div id="{{$idd}}-loading" class="{{$classs}}form-loading" style='display: flex; flex-direction: row; align-items:center;'>
   <p class="">{{$msg}}</p>
   <img src="images/loading.gif" style="width: 50px; height: 50px; margin-left: 5px;"/>
</div>