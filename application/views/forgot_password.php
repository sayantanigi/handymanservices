<?php
$get_setting = $this->Crud_model->get_single('setting');
?>
<style>
    header {
        display: none !important;
    }
</style>
<section class="max_height">
    <div class="block remove-bottom Sign_In">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-5">
                    <div class="account-popup-area signin-popup-box static">
                        <div class="logForm px-4 float-left w-100">
                            <a href="<?= base_url(); ?>" style="margin-left: 100px;">
                                <img class="Logo_Style" style="width: 250px;"
                                    src="<?= base_url(); ?>uploads/logo/<?= $get_setting->flogo ?>">
                            </a>
                            <h3 class="h3 font-weight-bold text-dark text-center mb-4">Forgot Password</h3>

                            <span class="text-success-msg f-20" style="text-align: center;">
                                <?php if ($this->session->flashdata('message')) {
                                    echo $this->session->flashdata('message');
                                    unset($_SESSION['message']);
                                } ?>
                            </span>
                            <form action="<?= base_url('user/login/send_forget_password') ?>" method="post">
                                <div class="error text-left mb-3">Registered Email Address</div>
                                <div class="cfield_Input">
                                    <input type="email" placeholder="Registered Email Address" name="email"
                                        id="forget_email" required class="form-control" />
                                    <span class="iconkey">
                                        <i class="la la-user"></i>
                                    </span>
                                </div>
                                <button type="submit" class="btn logbtn w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>