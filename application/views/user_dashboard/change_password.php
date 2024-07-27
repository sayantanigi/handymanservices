

<?php $this->load->view('sidebar');?>
<div class="col-lg-5 display-table-cell v-align form-design">
    <div class="user-dashboard User_Chng_Pass">
        <div class="text-success-msg f-20" style="text-align: center;">
            <?php if($this->session->flashdata('message')) {
                echo $this->session->flashdata('message');
                unset($_SESSION['message']);
            } ?>
        </div>
        <form class="form" action="#" method="post" enctype="multipart/form-data">
            <div class="row row">
                <div class="col-lg-12">
                    <h3 class="h3 font-weight-bold text-dark text-center mb-4">Change Password</h3>
                    <div class="cardak">
                        <div class="profile-dsd">
                            <div class="tab-content">
                                <div class="tab-pane active" style="padding: 0px;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="first_name">
                                                    <h4>Current Password <span style="color:red;">*</span>
                                                    <span id="err_current"></span></h4>
                                                </label>
                                                <input type="password" class="form-control" name="cur-password" id="cur-password" placeholder="Current Password" autocomplete="off" />
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="first_name">
                                                    <h4>New Password <span style="color:red;">*</span>
                                                    <span id="err_new"></span></h4>
                                                </label>
                                                <input type="password" class="form-control" name="new-password" id="new-password" placeholder="New Password" autocomplete="off" />
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="first_name">
                                                    <h4>Repeat Password <span style="color:red;">*</span>
                                                    <span id="err_confirm"></span></h4>
                                                </label>

                                                <input type="password" class="form-control" name="conf-password" id="conf-password" placeholder="Repeat Password" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><span id="matchPass1"></span></div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12 ">
                                                <button class="post-job-btn w-100" type="button" onclick="return change_password()"><i class="glyphicon glyphicon-ok-sign"></i>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</section>
