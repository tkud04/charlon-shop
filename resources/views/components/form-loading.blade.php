<?php
$idd = isset($id) ? $id : '';
$classs = isset($class) ? $class."-loading " : '';
$msg = isset($message) ? $message : 'Processing';
?>

<div id="{{$idd}}-loading" class="{{$classs}}form-loading">
   <p class="">{{$msg}} <img src="img/loading.gif" style="width: 50px; height: 50px; margin-left: 5px;"/></p>
</div>