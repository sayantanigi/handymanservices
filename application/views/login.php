<?php
$get_setting = $this->Crud_model->get_single('setting');
if (!empty($get_banner->image) && file_exists('uploads/banner/' . $get_banner->image)) {
    $banner_img = base_url("uploads/banner/" . $get_banner->image);
} else {
    $banner_img = base_url("assets/images/resource/mslider1.jpg");
} ?>
<style>
    /*.text-success-msg {display: none;}*/
    .text-invalid {
        color: red;
    }

    .text-danger {
        display: none;
    }

    .text-error {
        display: none;
    }

    #forgotpass_message {
        text-align: center;
        margin-top: 10px;
    }

    .bottom-line .scrollup {
        display: none;
    }

    header {
        display: none !important;
    }
</style>

<section class="max_height">
    <div class="block remove-bottom Sign_In">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-5">
                    <div>
                        <div class="logForm">
                            <div class="row m-0">
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center mb-3">
                                    <a href="<?= base_url(); ?>">
                                        <img class="Logo_Style" style="width: 250px;" src="<?= base_url(); ?>uploads/logo/<?= $get_setting->flogo ?>">
                                    </a>
                                    <h3 class="h3 font-weight-bold Primary_Text_Color">Welcome Back</h3>
                                    <span>Enter your Username and Password</span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 SignIn_Right">
                                    <?php if ($this->session->flashdata('message')) { ?>
                                        <div id="register-messages" class="text-invalid f-20 text-center">
                                            <span class="text-invalid f-15" style="text-align: center; margin-bottom: 10px;">
                                                <?php
                                                echo $this->session->flashdata('message');
                                                unset($_SESSION['message']);
                                                ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->flashdata('error')) { ?>
                                        <div id="err-messages">
                                            <span class="text-danger f-15 d-block" style="text-align: center; margin-bottom: 10px;">
                                                <?php echo $this->session->flashdata('error');
                                                unset($_SESSION['error']); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <form action="<?= base_url(); ?>validate" method="post">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="cfield">
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="username" name="email" class="form-control" />
                                                        <span class="iconkey">
                                                            <i class="la la-user"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="error text-left"><?php echo form_error('email'); ?></div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="cfield">
                                                    <div class="cfield_Input">
                                                        <input type="password" placeholder="password" name="password" id="login_pass" class="form-control" />
                                                        <span class="iconkey">
                                                            <i class="la la-key" onclick="checkPass()"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="error text-left"><?php echo form_error('password'); ?></div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 rememberme">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="remember-label m-0"><input type="checkbox" name="cb" id="cb1" /><label for="cb1">Remember me</label></p>
                                                    <div>
                                                        <a href="<?= base_url('forgot-password') ?>" title="" class="text-dark font-weight-bold">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3 SignIn_Remember text-center"></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 SignIn_Btn">
                                                <button type="submit" class="btn logbtn w-100 Gradient_Back_Color">Log In</button>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="extra-login">
                                                    <span>OR</span>
                                                    <div class="mt-3">
                                                        <a class="socialBtn" href="#" title=""><img src="<?= base_url(); ?>assets/images/google-icon.png"> Continue with Google</a>
                                                        <a class="socialBtn" href="#" title=""><img src="<?= base_url(); ?>assets/images/apple-icon.png"> Continue with Apple</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="logForm text-center mt-3">
                            <h6 class="mb-0 font-weight-bold text-dark">New here? <a href="<?= base_url('signup') ?>" class="text-primary">Join Sidequote</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="Forgot_Modal_Viwe MapShow" id="ForgotModalView">
    <div class="Forgot_Module">
        <span class="ForgotModal_Close_Icon" id="ForgotModalClose"><i class="fa fa-times" aria-hidden="true"></i></span>
        <div class="Forgot_Container">
            <div class="Forgot_Modal_Data">
                <div class="Forgot_Modal_Header">
                    <img src="https://cdn-icons-png.flaticon.com/512/6357/6357042.png">
                    <h3>Forgot Password</h3>
                    <span class="text-success-msg f-20">Message has been sent to your email id. Please check your inbox/spam folder for reset password link!</span>
                    <span class="text-danger f-20">Message could not be sent. Please try again later.</span>
                    <span class="text-error f-20">Email ID you have entered is not registered. Please register youself.</span>
                </div>
                <form action="" method="post">
                    <div class="row m-0">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="cfield">
                                <label for="" class="form-label">Email</label>
                                <div class="cfield_Input">
                                    <input type="email" placeholder="Registered Email Id" name="email" id="forget_email" required="">
                                    <i class="la la-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 Forgot_Btn">
                            <a href="javascript:void(0)" class="btn btn-info" onclick="forgotPass()">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" async="" src="<?php echo base_url(); ?>assets/js/Map_Modal.js"></script>
<script>
    function forgotPass() {
        var email = $('#forget_email').val();
        var base_url = $('#base_url').val();
        $.ajax({
            url: base_url + "user/login/send_forget_password",
            method: "POST",
            data: {
                email: email
            },
            success: function(data) {
                //alert(data);
                if (data == '1') {
                    $('.text-success-msg').show();
                    setTimeout(function() {
                        $('.text-success-msg').hide();
                    }, 2500);
                } else if (data == '2') {
                    $('.text-error').show();
                    setTimeout(function() {
                        $('.text-error').hide();
                    }, 2500);
                } else if (data == '3') {
                    $('.text-danger').show();
                    setTimeout(function() {
                        $('.text-danger').hide();
                    }, 2500);
                } else {
                    $('.text-danger').show();
                    setTimeout(function() {
                        $('.text-danger').hide();
                    }, 2500);
                }
            }

        })
    }

    function checkPass() {
        var x = document.getElementById("login_pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>