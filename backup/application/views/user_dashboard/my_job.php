<?php $get_setting = $this->Crud_model->get_single('setting'); ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= base_url('assets/images/resource/mslider1.jpg') ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header" style="padding-top: 90px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dashboardhak">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">My Jobs</h2>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('sidebar'); ?>
<div class="col-md-12 col-md-12 col-sm-12 display-table-cell v-align">
    <div id="product-messages" class="text-success-msg f-20">
        <p style="color: #28a745;">Job Deleted Successfully.</p>
    </div>
    <div id="err-messages">
        <h4 style="color: red;">Error</h4>
        <p style="color: red;">Oops, somthing went wrong. Please try again later.</p>
    </div>
    <div class="text-success-msg f-20" style="text-align: center;">
        <?php if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
        } ?>
    </div>
    <div class="user-dashboard">
        <div class="row row-sm">
        <?php
        if (!empty($get_postjob)) {
            $i = 1;
            foreach ($get_postjob as $key) {
                $string = strip_tags($key->post_title);
                if (strlen($string) > 100) {
                    $stringCut = substr($string, 0, 100);
                    $endPoint = strrpos($stringCut, ' ');
                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $string .= '...';
                }

                $getimage = $this->db->query("SELECT * FROM postjob_image WHERE job_id = '".$key->id."'")->row();
                $jobImage = $getimage->job_image;
                ?>
            <div class="col-lg-4 col-md-4 col-sm-12 MyJobContainer">
                <div class="MyJobBlock">
                    <img src="<?php echo base_url()?>uploads/postjob/<?= $jobImage; ?>" />
                    <div class="IconContainer">
                        <a href="<?php echo base_url('workdetail/' . base64_encode($key->id)) ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="<?php echo base_url('update-postjob/' . base64_encode($key->id)) ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="jobDelete(<?php echo $key->id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </div>
                    <div class="DataContainer">
                        <h3><?= $string;?></h3>
                        <?php if(!empty($key->duration)) { ?>
                        <p>Duration: <span><?= $key->duration . " "; ?></span></p>
                        <?php } ?>
                        <?php if(!empty($key->duration)) { ?>
                        <p>Deadline: <span><?= $key->appli_deadeline; ?></span></p>
                        <?php } ?>
                        <?php if(!empty($key->duration)) { ?>
                        <p>Remuneration ($): <span><?= "USD" . " " . $key->charges; ?></span></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php $i++; } } else { ?>
            <div class="col-12 MyJobContainer">
                <p>No Data Found</p>
                <?php if ($_SESSION['afrebay']['userType'] == '2') {
                    if ($get_setting->required_subscription == '1') {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription where employer_id = " . $_SESSION['afrebay']['userId'] . " and payment_status = 'paid'")->result_array();
                        if (!empty($get_sub_data)) {
                            $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '" . @$_SESSION['afrebay']['userId'] . "'")->result_array();
                            if (empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) { ?>
                                <button class="post-job-btn pull-right" type="submit" style=" background: linear-gradient(180deg, rgba(252, 119, 33, 1) 0%, rgba(249, 80, 30, 1) 100%) !important; border: 0 !important; "><a href="javascript:void(0)" onclick="completeSub()">Post Jobs</a></button>
                            <?php } else { ?>
                                <button class="post-job-btn pull-right" type="submit" style=" background: linear-gradient(180deg, rgba(252, 119, 33, 1) 0%, rgba(249, 80, 30, 1) 100%) !important; border: 0 !important; "><a href="<?= base_url('postwork') ?>" title="" target="_blank">Post Jobs</a></button>
                            <?php }
                        } else { ?>
                            <button class="post-job-btn pull-right" type="submit" style=" background: linear-gradient(180deg, rgba(252, 119, 33, 1) 0%, rgba(249, 80, 30, 1) 100%) !important; border: 0 !important; "><a href="javascript:void(0)" onclick="completeSub()">Post Jobs</a></button>
                        <?php }
                    } else { ?>
                        <button class="post-job-btn pull-right" type="submit" style=" background: linear-gradient(180deg, rgba(252, 119, 33, 1) 0%, rgba(249, 80, 30, 1) 100%) !important; border: 0 !important; "><a href="<?= base_url('postwork') ?>" title="" target="_blank">Post Jobs</a></button>
                <?php } } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</div>
<div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Project Title" name="name" />
                <input type="text" placeholder="Post of Post" name="mail" />
                <input type="text" placeholder="Author" name="passsword" />
                <textarea placeholder="Desicrption"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel" data-dismiss="modal">Close</button>
                <button type="button" class="add-project" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
</section>
<style>
#product-messages {display: none; text-align: center;}
#err-messages {display: none;text-align: center;}
@media screen and (max-width: 425px) {
    .User_Sidemenu .hidden-xs.display-table-cell .navi ul li a {
        border-radius: 10px !important;
        margin-bottom: 10px !important;
    }
    .navi ul li:nth-child(3) a span {
        font-size: 11px !important;
    }
    .cover {
        display: none !important;
    }
	.User_Sidemenu .hidden-xs.display-table-cell .navi ul li.active a {
		border-radius: 10px !important;
	}
	.User_Sidemenu .hidden-xs.display-table-cell .navi ul li.active {
		box-shadow: none !important;
	}
}
</style>
<script>
function jobDelete(id) {
    var p_id = id;
    $.confirm({
        title: 'Confirm!',
        content: confirmTextDelete,
        buttons: {
            confirm: function() {
                var base_url = $('#base_url').val();
                $.ajax({
                    url: base_url + "user/dashboard/delete_job",
                    method: "POST",
                    data: {
                        id: p_id
                    },
                    beforeSend: function() {
                        $("#loader").show();
                    },
                    success: function(data) {
                        if (data == '1') {
                            setTimeout(function() {
                                $("#loader").hide();
                                window.scroll({
                                    top: 0,
                                    behavior: "smooth"
                                });
                                $('#product-messages').show();
                            }, 7000);
                            setTimeout(function() {
                                $('#product-messages').hide();
                            }, 9000);
                            setTimeout(function() {
                                location.reload(true);
                            }, 10000);
                        } else {
                            $('#err-messages').show();
                            setTimeout(function() {
                                window.scroll({
                                    top: 0,
                                    behavior: "smooth"
                                })
                            }, 7000);
                            setTimeout(function() {
                                $('#err-messages').hide();
                            }, 9000);
                            setTimeout(function() {
                                location.reload(true);
                            }, 10000);
                        }
                    }

                })
            },
            cancel: function() {
                location.reload();
            },
        }
    });
}
</script>