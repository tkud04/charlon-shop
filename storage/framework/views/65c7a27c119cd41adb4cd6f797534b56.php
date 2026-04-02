<?php
$void = 'javascript:void(0)';
$title = "About Us";
$userMode = "dashboard";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .about-circle {
        width: 400px;
        height: 400px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-header',[
'title' => $title,
'subtitle' => "Brief overview of who we are and our core values"
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="hero-unit">
            <h2>Welcome to Computer City!</h2>
            <p>Your one-stop shop for high quality and affordable electronics, computers and your favorite gadgets.</p>
            <p>We're passionate about delivering the very best in technology and electronics at affordable prices. Whether you're shopping for a powerful laptop, a cutting-edge smartphone, an efficient printer, or must-have accessories, we've got exactly what you need.</p>
            <span class="small-bottom-border big"></span>

        </div>
    </div>
</div>

<div class="lg-margin2x"></div>
<?php echo $__env->make('components.widget-header',[
    'title' => "Why Shop With Us",
    'subtitle' => "Your trusted store for Computers & Electronics",
    'style' => "margin-top: 30px;"
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<div class="row" style="margin-top: 15px;">
  <?php
   foreach($points as $p)
   {
  ?>
	<div class="col-md-4 col-sm-4 col-xs-6 service-box-container">
		<div class="services-box">
			<div class="wwd">
        <i class="fa fa-<?php echo e($p['icon']); ?> wwd-icon"></i>
      </div>
			<h3>
				<a href="#"><?php echo e($p['title']); ?></a>
				<span class="small-bottom-border"></span>
			</h3>
			<p><?php echo $p['desc']; ?></p>
		</div>
	</div>
  <?php
   }
  ?>
	
</div>

<div class="lg-margin2x"></div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/about.blade.php ENDPATH**/ ?>