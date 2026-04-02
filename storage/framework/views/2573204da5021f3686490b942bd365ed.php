<?php
$void = 'javascript:void(0)';
$title = "Contact Us";
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.generic-banner',[
'title' => $title,
'description' => "Reach out to us on social media or send us a message"
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php 
$e = ""; $n = "";

if(isset($user))
{
  $e = $user->email;
  $n = $user->fname." ".$user->lname;
}
?>

<div class="container">
<div class="row">
  <div class="col-md-12" style="margin-bottom: 30px;">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.8805759272636!2d-117.61681172499156!3d33.42635775052057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80dcf46c2a8a1477%3A0x4904962204f9ad4f!2s149%20Avenida%20Del%20Mar%2C%20San%20Clemente%2C%20CA%2092672%2C%20USA!5e0!3m2!1sen!2sng!4v1775124251458!5m2!1sen!2sng" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <h2 class="sub-title">SEND MESSAGE</h2>
    <div class="row">
      <form>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Name*</span></span> <input type="text" name="contact-name" id="n" value="<?php echo e($n); ?>" required="" class="form-control input-lg" placeholder="Your Name"></div>
          <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">Email*</span></span> <input type="email" name="contact-email" id="e" value="<?php echo e($e); ?>" required="" class="form-control input-lg" placeholder="Your Email"></div>
          <div class="input-group"><span class="input-group-addon"><span class="input-icon input-icon-subject"></span><span class="input-text">Subject*</span></span> <input type="text" name="contact-subject" id="s" required="" class="form-control input-lg" placeholder="Subject"></div>
          <p class="item-desc">Your email address will not be published. Required fields are marked *</p>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="input-group textarea-container">
            <span class="input-group-addon"><span class="input-icon input-icon-message"></span><span class="input-text">Your Mesage</span></span>
            <textarea name="contact-message" id="b" class="form-control" cols="30" rows="6" placeholder="Your Message"></textarea>
          </div>
          <a id="contact-btn" href="#" class="btn btn-custom-2 md-margin">SUBMIT</a>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <h2 class="sub-title">CONTACT DETAILS</h2>
    <ul class="contact-details-list">
      
      <li><span class="contact-icon contact-icon-mobile"></span>
        <ul>
          <li>445-115-747-38</li>
          <li>445-170-029-32</li>
        </ul>
      </li>
      <li><span class="contact-icon contact-icon-email"></span>
        <ul>
          <li>Venedor@gmail.com</li>
          <li>Venedor@aol.com</li>
        </ul>
      </li>
    </ul>
  </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
   const confirmContact = (payload = {n,e,s,b}) => {
    confirmAction(payload, 
              (p) => {
                contact(
                p,
                (data) => {
                   toggleFormButton({id: 'contact',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Sent! Our admins would follow up with you within 24 hours');
                      window.location = '/';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'contact',mode: 'show'});
                    alert(`Failed to contact: ${err}`);
                }
            );
        }
      )  
   }
   
  $(() => {
    hideFormValidations();

    $('#contact-btn').click((e) => {
      e.preventDefault();
     
      toggleFormButton({id: 'contact', mode: 'hide'});
      const n = $('#n').val(), e2 = $('#e').val(), s = $('#s').val(), 
            b = $('#b').val();

      const v = n.length < 1 || e2.length < 1 || s.length < 1; //|| b.length < 1;

      if(v){
        if(n.length < 1) $('#n-validation').fadeIn();
        if(e2.length < 1) $('#e2-validation').fadeIn();
        if(s.length < 1) $('#s-validation').fadeIn();
        //if(b.length < 1) $('#b-validation').fadeIn();
        toggleFormButton({id: 'contact',mode: 'show'});
      }
      else{
        const p = {n,e:e2,s,b};
        
        confirmContact(p);
      }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/main/contact.blade.php ENDPATH**/ ?>