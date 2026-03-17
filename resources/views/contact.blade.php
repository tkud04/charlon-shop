<?php
$void = 'javascript:void(0)';
$title = "Contact Us";
$userMode = "dashboard";
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
   'title' => $title,
   'description' => "Reach out to us on social media or send us a message"
  ])


   <!-- contact us form area start -->
   <div id="down" class="tp-contact-us-form-ptb pre-header pt-60 pb-120">
               <div class="container container-1750 containers">
                  <div class="tp-contact-us-form-wrapper">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="tp-contact-us-map p-relative">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1289.6743363114015!2d3.30655152696399!3d6.50458876283089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8ee795657225%3A0xa9f8a0b2498729e1!2sG834%2BWWC%2C%20Ilasamaja%2C%20Lagos%20102214%2C%20Lagos!5e0!3m2!1sen!2sng!4v1772551598908!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="tp-contact-us-wrap">
                              <h4 class="tp-contact-us-title mb-55">Send a Message</h4>
                              <form id="contact-form">
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="tp-postbox-details-input mb-20">
                                          <label class="fs-18 tp-ff-p tp-text-common-black mb-10">Full name*</label>
                                          <input class="tp-input" id="name" type="text">
                                          @include('components.form-validation',['id' => 'name'])
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="tp-postbox-details-input mb-20">
                                          <label class="fs-18 tp-ff-p tp-text-common-black mb-10">Email address*</label>
                                          <input class="tp-input" id="email" type="email">
                                          @include('components.form-validation',['id' => 'email'])
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="tp-postbox-details-input mb-20">
                                          <label class="fs-18 tp-ff-p tp-text-common-black mb-10"> Subject*</label>
                                          <input class="tp-input" id="subject" type="text">
                                          @include('components.form-validation',['id' => 'subject'])
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="tp-postbox-details-input mb-20">
                                          <label class="fs-18 tp-ff-p tp-text-common-black mb-10">How Can We Help You*</label>
                                          <textarea class="tp-input tp-textarea" id="message"></textarea>
                                          @include('components.form-validation',['id' => 'message'])
                                       </div>
                                       <div class="tp-contact-form-btn">
                                          <button type="submit" id="contact-btn" class="tp-btn-xl w-100 d-inline-block lh-0 tp-round-26 fs-15 tp-bg-common-black text-uppercase ls-0 tp-btn-switch-animation tp-text-common-white hover-text-white tp-ff-heading fw-500">
                                             <span class="d-flex align-items-center justify-content-center">
                                                <span class="btn-text">Send Message</span>
                                                <span class="btn-icon">
                                                   <svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="white" />
                                                   </svg>
                                                </span>
                                                <span class="btn-icon">
                                                   <svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="white" />
                                                   </svg>
                                                </span>
                                             </span> 
                                          </button>
                                          @include('components.form-loading', ['message' => 'Loading', 'id' => "contact"])
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- contact us form area end -->            

            <!-- about area start -->
            <div class="cn-contactform-support-area mb-140">
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-xl-10">
                        <div class="cn-contactform-support-bg d-flex align-items-center justify-content-center" data-background="assets/img/contact/contact-us-shape.png">
                           <div class="cn-contactform-support-text text-center">
                                 <span>Or, you can contact one of our admins
                                    directly below. We aim to respond
                                    within 24 hours.</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- about area end -->

            <?php
             if(count($admins) > 0)
             {

            ?>
            <!-- contact area start -->
            <div class="tp-contact-us-info-area pb-120">
               <div class="container container-1230">
                  <div class="row">
                    <?php
                      foreach($admins as $a)
                      {
                    ?>
                     <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="tp-contact-us-content text-center" data-speed="1.2">
                           <div class="tp-contact-us-thumb d-flex justify-content-center">
                              <img src="assets/img/contact/contact-us-thumb-1.jpg" alt="">
                           </div>
                           <div class="tp-contact-us-bottom">
                              <div class="tp-contact-us-info-details">
                                 <h4 class="tp-contact-us-info-title">{{$a['name']}}</h4>
                                 <a href="mailto:{{$a['email']}}">{{$a['email']}}</a>
                                 <a href="tel:{{$a['phone']}}">{{$a['phone']}}</a>
                              </div>
                           </div>
                        </div>
                     </div>

                     <?php
                      }
                     ?>
                  </div>
               </div>
            </div>
            <!-- contact area end -->
            <?php
            }
            ?>

@stop


@section('scripts')
 <script>
    $(() => {
        hideFormValidations();

        $('#contact-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const name = $('#name').val(),  email = $('#email').val(),
            subject = $('#subject').val(),  body = $('#message').val();
           
            const v = name.length < 1 || email.length < 1 || subject.length < 1 || body.length < 1;

            if(v){
              if(name.length < 1) $('#name-validation').fadeIn();
              if(email.length < 1) $('#email-validation').fadeIn();
              if(subject.length < 1) $('#subject-validation').fadeIn();
              if(body.length < 1) $('#message-validation').fadeIn();
            }
            else{
             toggleFormButton({id: 'contact',mode: 'hide'});
             const payload = {
                n: name,
                e: email,
                s: subject,
                b: body
             };

            contact(
                payload,
                (data) => {
                   toggleFormButton({id: 'contact',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Message received! One of our admins would get back to you within 48hrs');
                      window.location = '{{url('/')}}';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'contact',mode: 'show'});
                    alert(`Failed to send message: ${err}`)
                }
            );
            }
            
        });
    });
 </script>
@stop