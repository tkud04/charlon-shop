<?php
$idd = isset($id) ? " id=".$id.'-btn' : "";
$t = isset($title) ? $title : 'Submit';
$ty = isset($type) ? $type : 'primary';
$oc = isset($onclick) ? " onclick='".$onclick."'" : "";
$hh = isset($href) ? " href={$href}" : "";
$sty = isset($style) ? "{$style}" : "";
?>

<?php
//<a style="{!! $sty !!}" class="btn btn-outline-{{$ty}}"{!!$oc!!}{{$hh}}{{$idd}}>{{$t}}</a>
?>
<button style="<?php echo $sty; ?>" class="btn btn-custom-2"<?php echo $oc; ?><?php echo e($hh); ?><?php echo e($idd); ?>><?php echo e($t); ?></button><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/button.blade.php ENDPATH**/ ?>