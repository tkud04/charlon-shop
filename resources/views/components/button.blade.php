<?php
$idd = isset($id) ? " id=".$id.'-btn' : "";
$t = isset($title) ? $title : 'Submit';
$ty = isset($type) ? $type : 'primary';
$oc = isset($onclick) ? " onclick='".$onclick."'" : "";
$hh = isset($href) ? " href={$href}" : "";
$sty = isset($style) ? "{$style}" : "";
?>

<a style="{!! $sty !!}" class="btn btn-outline-{{$ty}}"{!!$oc!!}{{$hh}}{{$idd}}>{{$t}}</a>