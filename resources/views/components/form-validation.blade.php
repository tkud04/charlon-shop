<?php
$idd = isset($id) ? $id : '';
$msg = isset($message) ? $message : 'This field is required';
?>

<div id="{{$id}}-validation" class="help-block with-errors form-validation">
   <p style="color: red;" class="text-bold">{{$msg}}</p>
</div>