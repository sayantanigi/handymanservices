<?php
$get_setting = $this->Crud_model->get_single('setting');
$seg2= $this->uri->segment(2);
$email=base64_decode($seg2);
$getUserid = $this->db->query("SELECT * FROM users WHERE email = '".$email."'")->row();
$uid = $getUserid->userId;
?>
<style>
header {display: none !important;}
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
                        <div class="account-popup-area signin-popup-box static">
                            <div class="logForm px-4 float-left w-100">
                                <a href="<?= base_url(); ?>" style="margin-left: 100px;">
                                    <img class="Logo_Style" style="width: 250px;" src="<?= base_url(); ?>uploads/logo/<?= $get_setting->flogo ?>">
                                </a>
                                <h3 class="h3 font-weight-bold text-dark text-center mb-4">Reset Password</h3>
                                <span class="f-20 submit_success" style="text-align: center; font-size: 16px !important;color: green !important;"></span>
                                <span class="f-20 submit_error" style="text-align: center; font-size: 16px !important;color: red !important;"></span>
                                <form method="post" style="margin-top: 20px !important;">
                                    <div class="error text-left mb-1" style="width: 35%; display: inline-block; float: left;">New Password </div>
                                    <div class="error text-left" id="err_password" style="width: 55%; display: inline-block;"></div>
                                    <div class="cfield_Input">
                                        <input type="password" placeholder="********" name="password" id="new_password" style="padding: 15px; border-radius: 10px;"/>
                                        <i class="la la-key" onclick="checkPass()" style="position: absolute; top: 16px; right: 10px;"></i>
                                    </div>

                                    <div class="error text-left mb-1" style="width: 35%; display: inline-block; float: left;">Confirm Password</div>
                                    <div class="error text-left" id="err_confirmpassword" style="width: 55%; display: inline-block;"></div>
                                    <div class="cfield_Input">
                                        <input type="password" placeholder="********" name="confirm_password" id="confirm_password" style="padding: 15px; border-radius: 10px;"/>
                                        <i class="la la-key" onclick="checkConfPass()" style="position: absolute; top: 16px; right: 10px;"></i>
                                    </div>
                                    <span id="matchPass2"></span>
                                    <button type="button" onclick="newpassword()" class="btn logbtn w-100">Submit</button>
                                    <input type="hidden" id="user_id" value="<?= $uid?>" >
                                </form>
                            </div>
                            <div class="logForm text-center mt-3">
                                <h6 class="mb-0 font-weight-bold text-dark"><a href="<?= base_url('login'); ?>" class="text-primary">Sign in</a></h6>
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
function newpassword() {
    var base_url=$('#base_url').val();
    var password=$("#new_password").val();
    var cpass=$("#confirm_password").val();
    var user_id=$("#user_id").val();
    if(password=="") {
        $("#err_password").fadeIn().html("Please enter password").css('color','red');
        setTimeout(function(){$("#err_password").html("");},3000);
        $("#new_password").focus();
        return false;
    }
    if(password.length<6) {
        $('#err_password').fadeIn().html('please enter at least 6 character').css('color','red');
        setTimeout(function(){$("#err_password").html("");},3000);
        $("#new_password").focus();
        return false;
    }
    if(cpass=="") {
        $("#err_confirmpassword").fadeIn().html("Please enter Confirm password").css('color','red');
        setTimeout(function(){$("#err_confirmpassword").html("");},3000);
        $("#confirm_password").focus();
        return false;
    }
    if(password!=cpass){
        $('#err_confirmpassword').html('Password does not match').css('color','red');
        setTimeout(function(){$("#err_confirmpassword").html("");},3000);
        return false;
    }
    $.ajax({
        type:'post',
        cache:false,
        url:base_url+'user/login/setnew_password',
        data:{
            user_id:user_id,
            password:password,
            cpass:cpass,
        },
        success:function(result) {
            if(result==1) {
                $('.submit_success').text('You have successfully reset your password. Please try to login.');
                setTimeout(function(){
                    window.location.href = '<?= base_url('login')?>';
                },3000);
            } else {
                $('.submit_error').text('Something went wrong. Please try again later!');
            }
        }
    });
}
function checkPass() {
	var x = document.getElementById("new_password");
  	if (x.type === "password") {
    	x.type = "text";
  	} else {
    	x.type = "password";
  	}
}
function checkConfPass() {
	var x = document.getElementById("confirm_password");
  	if (x.type === "password") {
    	x.type = "text";
  	} else {
    	x.type = "password";
  	}
}
</script>