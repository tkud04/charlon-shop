<?php
$void = 'javascript:void(0)';
$title = "Profile";
$userMode = "dashboard";
?>
@extends('layout')

@section('title',$title)


@section('content')
@include('components.generic-banner',[
   'title' => "Profile",
   'description' => "Here you can find and manage your personal information. You can also find announcements here and much more!"
  ])
<div class=" tp-portfolio-area pb-10">
<h2 class="text-white mx-2">Profile Info</h2>
<?php
  $avatar = $profile['avatar'] ? $profile['avatar'] : "img/avatar.png";
?>
<div class="tp-login-area pre-header pt-10 pb-140 p-relative z-index-1 fix">
               <div class="container container-1230 containers">
                  <div class="row justify-content-center">
                     <div class="col-xl-8 col-lg-10">
                        <div class="tp-login-wrapper">
                           <div class="tp-login-top text-center mb-30">
                              <h3 class="tp-login-title">You can preview your profile information below.</h3>
                           </div>
                           <div class="tp-login-option">
                              
                              <div class="tp-login-mail text-center mb-40">
                                 <p>We would never share your information with any third party.</p>
                              </div>
                              <div class="tp-login-input-wrapper">
                                <div class="row">
                                   <div class="col-md-12">
                                      <div class="text-center mt-4">
                                         <img src="{{$avatar}}" class="img-responsive" style="width: 200px; height: 200px; border-radius: 100px;" alt="Avatar"><br>
                                         <div class="row">
                                           <div class="col-md-3">
                                              <p class='mt-2 mb-4'>Change Profile picture </p>
                                           </div>
                                           <div class="col-md-6">
                                              <p class='mt-2 mb-4'><input type="file" id="pf"/> </p>
                                              @include('components.form-validation',['id' => 'pf','message' => "Please upload a file"])
                                           </div>
                                           <div class="col-md-3">
                                              <a href="#" id="pf-btn" class="tp-login-btn w-20 mb-10">Upload</a>
                                              @include('components.form-loading', ['message' => 'Loading', 'id' => "pf"])
                                           </div>
                                         </div>
                                         
                                         
                                      </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="tp-login-input-box">
                                         <div class="tp-login-input-title">
                                           <label for="fname">First Name</label>
                                         </div>
                                         <div class="tp-login-input">
                                            <input id="fname" type="text" placeholder="First name" value="{{$profile['fname']}}" disabled="">
                                            @include('components.form-validation',['id' => 'fname'])
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="tp-login-input-box">
                                         <div class="tp-login-input-title">
                                           <label for="lname">Last Name</label>
                                         </div>
                                         <div class="tp-login-input">
                                            <input id="lname" type="text" placeholder="Last name" value="{{$profile['lname']}}" disabled>
                                            @include('components.form-validation',['id' => 'lname'])
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                    <div class="tp-login-input-box">
                                    <div class="tp-login-input-title">
                                       <label for="email">Your Email</label>
                                    </div>
                                    <div class="tp-login-input">
                                       <input id="email" type="email" placeholder="email@mail.com" value="{{$profile['email']}}" disabled>
                                       @include('components.form-validation',['id' => 'email'])
                                    </div>
                                 </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="tp-login-input-box">
                                         <div class="tp-login-input-title">
                                           <label for="phone">Phone Number</label>
                                         </div>
                                         <div class="tp-login-input">
                                            <input id="phone" type="number" value="{{$profile['phone']}}" placeholder="Phone number" disabled>
                                            @include('components.form-validation',['id' => 'phone'])
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                    <div class="tp-login-input-box">
                                    <div class="tp-login-input-title">
                                       <label for="gender">Gender</label>
                                    </div>
                                    <div class="tp-login-input">
                                       <select id="gender" disabled>
                                          <option  value="none">Select an option</option>
                                          <?php
                                            $genders = [
                                                ['label' => "Male", 'value' => "male"],
                                                ['label' => "Female", 'value' => "female"],
                                            ];
                                            foreach($genders as $gender)
                                            {
                                                $ss = $gender['value'] === $profile['gender'] ? " selected" : "";
                                          ?>
                                          <option value="{{$gender['value']}}"{{$ss}}>{{$gender['label']}}</option>
                                          <?php
                                            }
                                          ?>
                                       </select>
                                       @include('components.form-validation',['id' => 'gender'])
                                    </div>
                                 </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="tp-login-input-box">
                                         <div class="tp-login-input-title">
                                           <label for="phone">Birthday</label>
                                         </div>
                                         <div class="tp-login-input">
                                            <input id="bday" type="date" value="{{$profile['bday']}}" placeholder="Birthday" disabled>
                                            @include('components.form-validation',['id' => 'bday'])
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tp-login-input-box mt-4">
                                         <div class="tp-login-input-title">
                                           <label for="username">Preferred Username</label>
                                         </div>
                                         <div class="tp-login-input">
                                            <input id="username" type="text" placeholder="Your username" value="{{$profile['username']}}" disabled>
                                            @include('components.form-validation',['id' => 'username'])
                                          </div>
                                        </div>
                              </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div> 

</div>

@stop

@section('scripts')
 <script>
    $(() => {
        hideFormValidations();

        $('#pf-btn').click(e => {
            e.preventDefault();
            hideFormValidations();

            const pf = document.querySelector('#pf').files.item(0);
            
            const v = pf === null;
            if(v){
               if(pf === null) $('#pf-validation').fadeIn();
            }
            else{
               //console.log('pf: ',pf);

             toggleFormButton({id: 'pf',mode: 'hide'});
             const payload = {
                pf
             };

            uploadAvatar(
                payload,
                (data) => {
                   toggleFormButton({id: 'pf',mode: 'show'});

                   if(data.status === 'ok'){
                    alert('Avatar uploaded!');
                      window.location = 'profile';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'pf',mode: 'show'});
                    alert(`Failed to upload avatar: ${err}`)
                }
            );

            }
            
            
        });
    });
</script>
@stop