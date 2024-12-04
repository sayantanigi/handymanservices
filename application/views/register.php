<?php
$get_setting = $this->Crud_model->get_single('setting');
if (!empty($get_banner->image) && file_exists('uploads/banner/' . $get_banner->image)) {
    $banner_img = base_url("uploads/banner/" . $get_banner->image);
} else {
    $banner_img = base_url("assets/images/resource/mslider1.jpg");
} ?>
<style>
#register-messages { text-align: center; margin-top: 25px; display: none; }
#register-messages-notemail { text-align: center; margin-top: 25px; display: none; }
#err-messages { text-align: center; margin-top: 10px; display: none; }
</style>
<div class="shutter left"></div>
<div class="shutter right"></div>
<div class="content">
    <section>
        <video autoplay muted loop class="background-video">
            <source src="<?= base_url(); ?>assets/video/backg-video.mp4" type="video/mp4">
        </video>
    </section>
    <section class="max_height">
        <div class="block remove-bottom Sign_Up">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6 regcontent">
                        <img class="Logo_Style" src="<?= base_url(); ?>uploads/logo/<?= $get_setting->flogo ?>">
                        <?= htmlspecialchars_decode($get_setting->register_body_header); ?>
                        <?= htmlspecialchars_decode($get_setting->register_body_content); ?>
                    </div>
                    <div class="col-lg-5">
                        <div class="logForm">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?= htmlspecialchars_decode($get_setting->register_form_header); ?>
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
                                                <!-- <div class="col-lg-12">
                                                    <div class="extra-login reg mb-3">
                                                        <div class="mb-3">
                                                            <a class="socialBtn" href="#" title=""><img src="<?= base_url(); ?>assets/images/google-icon.png"> Continue with Google</a>
                                                            <a class="socialBtn" href="#" title=""><img src="<?= base_url(); ?>assets/images/apple-icon.png"> Continue with Apple</a>
                                                        </div>
                                                        <span>OR</span>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-6 col-md-6 col-sm-6 first_name">
                                                    <div class="cfield cfield_top">
                                                        <div class="cfield_Input">
                                                            <input type="text" placeholder="First Name" name="first_name" id="first_name" onkeypress="only_alphabets(event)" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 last_name">
                                                    <div class="cfield cfield_top">
                                                        <div class="cfield_Input">
                                                            <input type="text" placeholder="Last Name" name="last_name" id="last_name" onkeypress="only_alphabets(event)" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 username">
                                                    <div class="cfield cfield_top">
                                                        <div class="cfield_Input">
                                                            <div class="error text-left" id="err_username"></div>
                                                            <input type="text" placeholder="User Name" name="username" id="username" class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 email">
                                                    <div class="cfield cfield_top">
                                                        <div class="cfield_Input">
                                                            <div class="error text-left" id="err_email"></div>
                                                            <input type="text" placeholder="Email Address or Phone Number" name="email" id="email" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 pass">
                                                    <div class="cfield cfield_top">
                                                        <div class="cfield_Input">
                                                            <div class="error text-left" id="err_password"></div>
                                                            <input type="password" placeholder="Password" name="password" id="password" class="form-control" />
                                                            <span class="iconkey"><i class="la la-key" onclick="checkPass()"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 c_pass">
                                                    <div class="cfield cfield_top">
                                                        <div class="cfield_Input">
                                                            <div class="error text-left" id="err_confpassword"></div>
                                                            <input type="password" placeholder="Confirm Password" name="conf_password" id="conf_password" class="form-control" style="margin: 0px;"/>
                                                            <span class="iconkey"> <i class="la la-key" onclick="checkConfPass()"></i></span>
                                                        </div>
                                                        <div class="error text-left" id="err_check_pass"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 SignUp_Btn">
                                                    <button type="button" class="btn logbtn w-100 mt-4 Gradient_Back_Color" id="rSignUp" onclick="return btn_register();">Continue</button>
                                                    <input type="hidden" name="location" id="location" value="<?= @$loc ?>" placeholder="Set Location" />
                                                    <input type="hidden" id="search_lat" name="s_lat" value="<?= @$lat ?>">
                                                    <input type="hidden" id="search_lon" name="s_lon" value="<?= @$lon ?>">
                                                </div>
                                                <div class="col-lg-12 text-center mt-3">
                                                    <small><input type="checkbox" id="agreecheck" style="opacity: 1; z-index: 50; margin-top: 8px;"> I agree to the <a href="<?= base_url()?>privacy-policy" target="_blank" class="text-primary">Privacy Policy</a>, <a href="<?= base_url()?>cookies-policy" target="_blank" class="text-primary">Cookie Policy</a> and <a href="<?= base_url()?>member-agreement" target="_blank" class="text-primary">Member Agreement</a>.</small>
                                                    <p class="erroragree" style="margin: 0;width: 100%;text-align: center;color: red;font-size: 12px;"></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="logForm" style="width :48%; margin-top: 10px; display: flex; float: left; margin-right: 20px;">
                            <div class="col-lg-12 text-center">
                                <a href="<?= base_url() ?>login" class="text-primary font-weight-bold">Sign In</a>
                            </div>
                        </div>
                        <div class="logForm" style="width :48%; margin-top: 10px; display: flex; float: left; padding: 19px;">
                        <div class="col-lg-12 text-center">
                            <form id="signUp_form" action="<?= base_url()?>view_as_guest" method="post">
                                <input type="hidden" name="location_guest" id="location_guest" value="<?= @$loc ?>" placeholder="Set Location" />
                                <input type="hidden" id="search_lat_guest" name="s_lat_guest" value="<?= @$lat ?>">
                                <input type="hidden" id="search_lon_guest" name="s_lon_guest" value="<?= @$lon ?>">
                                <input type="submit" class="text-primary font-weight-bold" name="submit" value="Proceed as Guest" style="border: none; background: none;">
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
#loader {
    display: none;
    width: 40px;
}
header {
    display: none !important;
}
</style>
<script src="<?= base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/register.js') ?>"></script>
<script>
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
});
$(document).ready(function() {
    $('#username').on( "keypress", function() {
        console.log($('#username').val().length);
        if($('#username').val().length > 6) {
            var username = $('#username').val();
            console.log(username);
            $("#err_username").html("");
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/Login/checkusername')?>",
                data: {username: username},
                dataType:'json',
                beforeSend : function(){},
                success:function(returndata) {
                    //console.log(returndata.result);
                    if(returndata.result == 'success') {
                        $('#err_username').fadeIn().html(returndata.data).css({'color':'green','margin-bottom':'5px'});
                        $("#rSignUp").prop("disabled", false);
                    } else {
                        $('#err_username').fadeIn().html(returndata.data).css({'color':'red','margin-bottom':'5px'});
                        setTimeout(function(){$("#err_username").html("");},3000);
                        $("#username").focus();
                        $("#rSignUp").prop("disabled", true);
                        return false;
                    }
                }
            })
        } else {
            $('#err_username').html('Username should be at least 8 characters long');
            $('#err_username').css({'color':'red'});
            $('#username').css({'color':'red', 'border':'1px solid red'});
            //setTimeout(function(){$("#err_username").html("");},3000)
            $("#err_username").focus();
            //return false;
            $('#rSignUp').prop("disabled", true);
        }
    })
})
</script>
