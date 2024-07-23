<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)) {
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<style>
#register-messages {text-align: center; margin-top: 25px; display: none;}
#register-messages-notemail {text-align: center; margin-top: 25px; display: none;}
#err-messages {text-align: center; margin-top: 10px; display: none;}
</style>
<div class="shutter left"></div>
  <div class="shutter right"></div>
  <div class="content">
<section >
     <video autoplay muted loop class="background-video"  data-aos="zoom-out" data-aos-duration="2000">
        <source src="<?php base_url(); ?>assets/video/backg-video.mp4" type="video/mp4">
    </video>
</section>
<section class="max_height">
    <div class="block remove-bottom Sign_Up">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 regcontent"  data-aos="fade-right" data-aos-duration="3000">
                    <h1 class="mb-3 text-dark">Craft Your Success <br> Join <span class="text-primary"> 411web3 </span> Network</h1>
                    <p class="text-dark">Transform Your Handyman Career: Post Your Work, Discover Job
Opportunities, and Connect with Skilled Professionals</p>
                </div>
                <div class="col-lg-5" data-aos="fade-left" data-aos-duration="3000">
                    <div class="logForm">
                        <div >
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="h3 font-weight-bold text-dark text-center">Start Your <br> Handyman Journey</h3>
                                    <!-- div class="select-user mb-3">
                                        <span class="user-tab active" user_type="1" onclick="get_value(1)">Professional</span>
                                        <span class="user-tab" user_type="2" onclick="get_value(2)">Customer</span>
                                    </div>
                                    <div class="error" id="err_usertype"></div> -->
                                </div>
                                <div class="col-lg-12">
                                    <div id="register-messages" class="text-success-msg f-20">
                                        <h4>Successful Registration</h4>
                                        <p style="color: #28a745;"></p>
                                    </div>
                                    <div id="err-messages">
                                        <h4 style="color: red;">Error</h4>
                                        <p style="color: red;"></p>
                                    </div>
                                    <form id="signUp_form" action="#" method="post">

                                        <div class="row m-0">
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 first_name">
                                                <div class="cfield cfield_top">
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="First Name" name="first_name" id="first_name" onkeypress="only_alphabets(event)" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_firstname"></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 last_name">
                                                <div class="cfield cfield_top">
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="Last Name" name="last_name" id="last_name" onkeypress="only_alphabets(event)" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_lastname"></div>
                                            </div>
                                            <div class="col-lg-12 company_name">
                                                <div class="cfield cfield_top">
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="Company Name" name="company_name" id="company_name" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_companyname"></div>
                                            </div> -->
                                            <div class="col-lg-12">
                                                <div class="extra-login reg mb-3">
                                                    
                                                    <div class="mb-3">
                                                        <a class="socialBtn" href="#" title=""><img src="<?php base_url(); ?>assets/images/google-icon.png"> Continue with Google</a>
                                                        <a class="socialBtn" href="#" title=""><img src="<?php base_url(); ?>assets/images/apple-icon.png"> Continue with Apple</a>
                                                    </div>
                                                    <span>OR</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 email">
                                                <div class="cfield cfield_top">
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="Email Address" name="email" id="email" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_email"></div>
                                            </div>
                                            <!-- div class="col-lg-12 addrss">
                                                <div class="cfield cfield_top">
                                                    <div class="cfield_Input">
                                                        <input type="text" class="form-control" name="address" id="location" placeholder="Legal Address" autocomplete="off" required class="form-control" />
                                                        <input type="hidden" name="latitude" id="search_lat" value="">
                                                        <input type="hidden" name="longitude" id="search_lon" value="">
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_address"></div>
                                            </div> -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 pass">
                                                <div class="cfield cfield_top">
                                                    <div class="cfield_Input">
                                                        <input type="password" placeholder="Password" name="password" id="password" class="form-control" />
                                                        <span class="iconkey"><i class="la la-key" onclick="checkPass()"></i></span>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_password"></div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 c_pass">
                                                <div class="cfield cfield_top">
                                                    <div class="cfield_Input">
                                                        <input type="password" placeholder="Confirm Password" name="conf_password" id="conf_password" class="form-control" />
                                                       <span class="iconkey"> <i class="la la-key" onclick="checkConfPass()"></i></span>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_confpassword"></div>
                                            </div>
                                            <div class="col-lg-12 email mb-3">
                                                <div class="cfield cfield_top">
                                                    <div class="cfield_Input">
                                                        <select class="form-control form-select">
                                                            <option>Choose account type</option>
                                                            <option>Customer</option>
                                                            <option>Business Provider</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_email"></div>
                                            </div>
                                            
                                            <div class="col-lg-12 col-md-6 col-sm-6" id="err_check_pass" style="tex-align:center;"></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 SignUp_Btn">
                                                <input type="hidden" name="user_type" id="user_type">
                                                <button type="button" class="btn logbtn w-100" id="rSignUp" onclick="return btn_register();">Continue</button>
                                            </div>
                                            <div class="col-lg-12 text-center mt-3">
                                                <a href="#" class="text-primary font-weight-bold">Register as a Guest</a>
                                            </div>
                                            <div class="col-lg-12 text-center mt-3">
                                                <small>By signing up, you agree to our <a href="#" class="text-primary">Privacy Policy</a>, <a href="#" class="text-primary">Cookie Policy</a> and <a href="#" class="text-primary">Member Agreement</a>.</small>
                                            </div>
                                            
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<style>
#loader {display: none; width: 40px;}
.company_name {display: none}
</style>
<script src="<?= base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#user_type').val(1);
})
function get_value(id) {
    $('#user_type').val(id);
    if(id == 1){
        $('.company_name').hide();
        $('.first_name').show();
        $('.last_name').show();
        $('.email').show();
        $('.pass').show();
        $('.c_pass').show();
        $('.addrss').show();
    } else {
        $('.company_name').show();
        $('.first_name').show();
        $('.last_name').show();
        $('.email').show();
        $('.pass').show();
        $('.c_pass').show();
        $('.addrss').show();
    }
}
</script>
<script>
    window.addEventListener('load', () => {
      document.body.classList.add('loaded');
    });
  </script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/register.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    AOS.init();
  </script>