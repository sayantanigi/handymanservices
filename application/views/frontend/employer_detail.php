<?php
if (!empty($userdata->backgroundPic) && file_exists('uploads/users/background/' . $get_banner->backgroundPic)) {
    $banner_img=base_url("uploads/users/background/".$userdata->backgroundPic);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<section style="width: 100%; height: 200px;">
    <div style="width: 100%; height: 100%; position: relative;">
        <div style="background: #c34e102b; position: absolute; z-index: 1; width: 100%; height: 100%;"></div>
        <img style="width: 100%; height: 100%; object-fit: cover;" src="<?= $banner_img ?>" />
    </div>
</section>

<section>
    <div class="block Employer_Details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 column">
                    <div class="job-single-sec style3">
                        <div class="job-head-wide">
                            <div class="row">
                                <div class="col-lg-10 col-md-12 col-sm-12">
                                    <div class="job-single-head3 emplye">
                                        <div class="job-thumb">
                                            <?php if (@$userdata->profilePic && file_exists('uploads/users/' . @$userdata->profilePic)) { ?>
                                            <img id="profile-img" src="<?= base_url('uploads/users/'.@$userdata->profilePic)?>" class="online" alt="" />
                                            <?php } else { ?>
                                            <img id="profile-img" src="<?= base_url('uploads/no_pimage.png')?>" class="online" alt="" />
                                            <?php } ?>
                                        </div>
                                        <div class="job-single-info3">
                                            <h3>
                                                <?php
                                                $companyname = $userdata->companyname;
                                                if (!empty($companyname)) {
                                                    echo $name = ucwords($companyname);
                                                } else {
                                                    echo $name = ucwords($userdata->firstname." ".$userdata->lastname);
                                                } ?>
                                            </h3>
                                            <?php if(@$_SESSION['afrebay']['userId'] != $userdata->userId) { ?>
                                            <!-- <div id="status-options">
                                                <?php if(!empty(@$_SESSION['afrebay']['userId'])) {
                                                $checkMuteUser = $this->db->query("SELECT * FROM mute_user WHERE to_user_id = '".$userdata->userId."' AND from_user_id = '".$_SESSION['afrebay']['userId']."'")->row();
                                                //print_r($checkMuteUser);
                                                if(@$checkMuteUser->status == "1") { ?>
                                                <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 10px; display: inline-block;" onclick="unmuteUser(<?= $userdata->userId ?>)"><i class="las la-volume-up"></i> Unmute</a>
                                                <?php } else { ?>
                                                <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 10px; display: inline-block;" onclick="muteUser(<?= $userdata->userId ?>)"><i class="las la-volume-off"></i> Mute</a>
                                                <?php } } else { ?>
                                                <a href="<?php echo base_url()?>login" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 10px; display: inline-block;"><i class="las la-volume-off"></i> Mute</a>
                                                <?php } ?>
                                                <?php if(!empty(@$_SESSION['afrebay']['userId'])) {
                                                $checkreportUser = $this->db->query("SELECT * FROM report_user WHERE to_user_id = '".$userdata->userId."' AND from_user_id = '".$_SESSION['afrebay']['userId']."'")->row();
                                                //print_r($checkreportUser);
                                                if(!empty($checkreportUser)) { ?>
                                                <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 10px; display: inline-block;"><i class="la la-flag"></i> Reported</a>
                                                <?php } else { ?>
                                                <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 10px; display: inline-block;" onclick="report(<?= $userdata->userId ?>)"><i class="la la-flag"></i> Report</a>
                                                <?php } } else { ?>
                                                <a href="<?php echo base_url()?>login" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 10px; display: inline-block;"><i class="la la-flag"></i> Report</a>
                                                <?php } ?>

                                                <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 10px; display: inline-block;" id="shareBtn"><i class="la la-share"></i> Forward </a>
                                            </div>
                                            <div id="shareMenu" class="hidden">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('customer_detail/' . base64_encode(@$userdata->userId)) ?>" target="_blank" class="fa fa-facebook"></a>
                                                <a href="https://twitter.com/intent/tweet?text=<?php echo $post_data->post_title; ?>&url=<?= base_url('customer_detail/' . base64_encode(@$userdata->userId)) ?>" target="_blank" class="fa fa-twitter"></a>
                                                <a href="mailto:?subject=<?php echo $name; ?>&body=<?= 'I found this interesting: '.base_url('customer_detail/' . base64_encode(@$userdata->userId)) ?>" target="_blank" class="fa fa-google"></a>
                                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= base_url('customer_detail/' . base64_encode(@$userdata->userId)) ?>" target="_blank" class="fa fa-linkedin"></a>
                                                <a href="https://www.instagram.com/?url=<?= base_url('customer_detail/' . base64_encode(@$userdata->userId)) ?>" target="_blank" class="fa fa-instagram"></a>
                                                <a href="https://api.whatsapp.com/send?text=<?php echo $post_data->post_title; ?> <?= base_url('customer_detail/' . base64_encode(@$userdata->userId)) ?>" target="_blank" class="fa fa-whatsapp"></a>
                                                <a href="https://telegram.me/share/url?url=<?= base_url('customer_detail/' . base64_encode(@$userdata->userId)) ?>&text=<?php echo $post_data->post_title; ?>" target="_blank" class="fa fa-telegram"></a>
                                            </div> -->
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="job-wide-devider">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="job-details">
                                        <h3 class="Primary_Text_Color">About
                                        <?php
                                        $companyname = $userdata->companyname;
                                        if (!empty($companyname)) {
                                            echo ucwords($companyname);
                                        } else {
                                            echo ucwords($userdata->firstname." ".$userdata->lastname);
                                        } ?>
                                        </h3>
                                        <p><?= @$userdata->short_bio; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12 column">
                                <?php if (!empty($get_post)) { ?>
                                    <div class="recent-jobs">
                                        <h3 class="Primary_Text_Color">Jobs from
                                        <?php
                                        $companyname = $userdata->companyname;
                                        if (!empty($companyname)) {
                                            echo ucwords($companyname);
                                        } else {
                                            echo ucwords($userdata->firstname." ".$userdata->lastname);
                                        } ?>
                                        </h3>
                                        <div class="job-list-modern">
                                            <div class="job-listings-sec no-border">
                                                <?php
                                                //echo "<pre>"; print_r($get_post);
                                                $total_post = count($get_post);
                                                foreach ($get_post as $key) {
                                                ?>
                                                <div class="job-listing wtabs noimg col-lg-6 col-md-6 col-sm-12">
                                                    <div class="CustomBlockDesign">
                                                        <?php
                                                        $getJobImage = $this->db->query("SELECT * FROM postjob_image WHERE job_id = '".$key->id."'")->row();
                                                        if(!empty($getJobImage->job_image) && file_exists('uploads/postjob/'.$getJobImage->job_image)) {
                                                            $jobimage = base_url("uploads/postjob/".$getJobImage->job_image);
                                                        } else {
                                                            $jobimage = base_url("uploads/no_bimage.png");
                                                        }
                                                        ?>
                                                        <img src="<?= $jobimage; ?>" />
                                                        <div class="CustomContainer">
                                                            <div class="job-title-sec">
                                                                <h3 style="text-transform: uppercase;">
                                                                    <a href="<?php echo base_url() ?>workdetail/<?php echo base64_encode($key->id) ?>" title="">
                                                                        <?php
                                                                        $string = strip_tags($key->post_title);
                                                                        if (strlen($string) > 200) {

                                                                            // truncate string
                                                                            $stringCut = substr($string, 0, 100);
                                                                            $endPoint = strrpos($stringCut, ' ');

                                                                            //if the string doesn't contain any space then it will cut without word basis.
                                                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                                            $string .= '... <a href="'.base_url().'workdetail/'.base64_encode($key->id).'">Read More</a>';
                                                                        }
                                                                        echo $string;
                                                                        ?>
                                                                    </a>
                                                                </h3>
                                                                <span><?php echo $key->required_key_skills; ?></span>
                                                                <!-- <div class="job-lctn"><i class="la la-map-marker"></i><?= ucwords($key->location); ?></div> -->
                                                            </div>
                                                            <div class="job-style-bx">
                                                                <span class="fav-job"><i class="la la-heart-o"></i></span>
                                                                <i><?php echo date('d-m-Y', strtotime($key->created_date)); ?></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 column">
                                    <?php
                                    $uri = "$_SERVER[REQUEST_URI]";
                                    $uri = explode('/', $uri);
                                    $uri = end($uri);
                                    if($_SESSION['afrebay']['userId'] != base64_decode($uri)){?>
                                    <div class="job-overview">
                                        <h3 class="Primary_Text_Color">Review <?= "@".$_SESSION['afrebay']['username']?></h3>
                                        <form method="post" action="<?= base_url('user/dashboard/save_employer_rating')?>">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px;">
                                                    <span class="star-rating star-5">
                                                        <input type="radio" name="rating" value="1"><i></i>
                                                        <input type="radio" name="rating" value="2"><i></i>
                                                        <input type="radio" name="rating" value="3"><i></i>
                                                        <input type="radio" name="rating" value="4"><i></i>
                                                        <input type="radio" name="rating" value="5"><i></i>
                                                    </span>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 Form_Subject">
                                                    <input type="text" placeholder="Enter Subject" name="subject" required style="border-radius: 10px;"/>
                                                    <input type="hidden" value="<?= @base64_decode($uri) ?>" name="user_id">
                                                    <input type="hidden" value="<?= @$_SESSION['afrebay']['userType'] ?>" name="userType">
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 Form_Textarea" >
                                                    <textarea placeholder="Enter review" name="review" style="border-radius: 10px;"></textarea>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 Form_Btn">
                                                    <button class="submit btn btn-info Gradient_Back_Color" style="background: #2892ff;border-radius: 30px;min-height: 30px;min-width: 52px;">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>
                                </div>
                                <?php
                                $getSavedPost = $this->db->query("SELECT * FROM users_save_post WHERE user_id = '".@$userdata->userId."'")->result_array();
                                if (!empty($getSavedPost)) {
                                    $i = 1;
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="Product_Details">
                                        <h3 class="mt-5 mb-5 Primary_Text_Color">Saved Post</h3>
                                        <div class="row">
                                            <?php foreach ($getSavedPost as $value) {
                                                $post_details = $this->db->query("SELECT * FROM postjob WHERE id = '".$value['post_id']."'")->row();
                                                $post_detailsimg = $this->db->query("SELECT * FROM postjob_image WHERE job_id = '".$value['post_id']."'")->row();?>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="Product">
                                                    <div class="Product_Img">
                                                        <?php if(!empty($post_detailsimg)) { ?>
                                                        <img src="<?php echo base_url() ?>uploads/postjob/<?php echo $post_detailsimg->job_image ?>">
                                                        <?php } else { ?>
                                                        <img src="<?php echo base_url() ?>uploads/no_bimage.png">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="Product_Data">
                                                        <p class="mt-2 mb-2"><span><?php echo $post_details->post_title ?></span></p>
                                                        <?php $userDetails = $this->db->query("SELECT * FROM users WHERE userId = '".$value['user_id']."'")->row();?>
                                                        <p><span><?= $userDetails->username; ?></span>
                                                        </p>
                                                        <a href="<?php echo base_url() ?>workdetail/<?php echo base64_encode($value['post_id']) ?>" type="button" class="btn btn-info Gradient_Back_Color">View Post</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++; } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="Map_Viwe" id="MapView">
    <div class="Map_Module">
        <span class="Close_Icon" id="MapClose"><i class="fa fa-times" aria-hidden="true"></i></span>
        <div class="Map_Container">
            <iframe src="https://maps.google.it/maps?q=<?= @$userdata->address ?>&output=embed" height="70%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 550px !important; position: relative; top: 80px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="reason" name="reason"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="reportUser()">Save changes</button>
                <input type="hidden" id="toUser" name="toUser" value="">
                <input type="hidden" id="fromUser" name="fromUser" value="<?= $_SESSION['afrebay']['userId']?>">
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    const shareBtn = $('#shareBtn');
    const shareMenu = $('#shareMenu');
    shareBtn.click(function() {
        shareMenu.toggle();
    });
});
function show_map() {
    $('#show_maping').show();
}
$(".job-thumb").click(function() {
    //$("#status-options").toggle();
});
$("#status-options ul li").click(function() {
    $("#profile-img").removeClass();
    $("#status-online").removeClass("active");
    $("#status-away").removeClass("active");
    $("#status-busy").removeClass("active");
    $("#status-offline").removeClass("active");
    $(this).addClass("active");
    if ($("#status-online").hasClass("active")) {
        $("#profile-img").addClass("online");
    } else if ($("#status-away").hasClass("active")) {
        $("#profile-img").addClass("away");
    } else if ($("#status-busy").hasClass("active")) {
        $("#profile-img").addClass("busy");
    } else if ($("#status-offline").hasClass("active")) {
        $("#profile-img").addClass("offline");
    } else {
        $("#profile-img").removeClass();
    };
    //$("#status-options").toggle();
});
function report(userid) {
    var toUser = userid;
    var fromUser = <?php if(!empty(@$_SESSION['afrebay']['userId'])) { echo $_SESSION['afrebay']['userId']; } else { echo "NULL"; } ?>;
    if(fromUser != "NULL") {
        $('#exampleModal').addClass('show');
        $('#exampleModal').modal('show');
        $('#toUser').val(toUser);
    }
}
function reportUser() {
    var toUser = $('#toUser').val();
    var fromUser = $('#fromUser').val();
    var reason = $('#reason').val();
    $.ajax({
        url: "<?= base_url('user/dashboard/reportUser') ?>",
        type: "POST",
        data: {toUser: toUser, fromUser: fromUser, reason: reason},
        success: function(response) {
            if (response == "1") {
                location.reload();
            } else {
                $('#error').text(response);
            }
        }
    })
}
function muteUser(userid) {
    var toUser = userid;
    var fromUser = <?php if(!empty(@$_SESSION['afrebay']['userId'])) { echo $_SESSION['afrebay']['userId']; } else { echo "NULL"; } ?>;
    if(fromUser != "NULL") {
        $.ajax({
            url: "<?= base_url('user/dashboard/muteUser') ?>",
            type: "POST",
            data: {toUser: toUser, fromUser: fromUser},
            success: function(response) {
                if (response == "1") {
                    location.reload();
                } else {
                    $('#error').text(response);
                }
            }
        })
    }
}
function unmuteUser(userid) {
    var toUser = userid;
    var fromUser = <?php if(!empty(@$_SESSION['afrebay']['userId'])) { echo $_SESSION['afrebay']['userId']; } else { echo "NULL"; } ?>;
    if(fromUser != "NULL") {
        $.ajax({
            url: "<?= base_url('user/dashboard/unmuteUser') ?>",
            type: "POST",
            data: {toUser: toUser, fromUser: fromUser},
            success: function(response) {
                if (response == "1") {
                    location.reload();
                } else {
                    $('#error').text(response);
                }
            }
        })
    }
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" async="" src="<?php echo base_url(); ?>assets/js/Map_Modal.js"></script>
<style>
.CustomBlockDesign {position: relative; height: 300px;}
.CustomBlockDesign img {width: 100%; height: 100%; border-radius: 15px; object-fit: cover;}
.CustomBlockDesign .CustomContainer {padding: 10px 15px !important; position: absolute; bottom: 0; background: rgb(0 0 0 / 20%); backdrop-filter: blur(5px); width: 100%; border-radius: 0 0 15px 15px;}
.CustomBlockDesign .CustomContainer .job-title-sec h3,
.CustomBlockDesign .CustomContainer .job-title-sec span {color: #fff !important;}
.CustomBlockDesign .CustomContainer .job-title-sec .job-lctn,
.CustomBlockDesign .CustomContainer .job-title-sec .job-lctn i {color: #fff !important;}
.job-style-bx i, .job-style-bx .fav-job i {color: #fff !important;}
#status-options {width: auto; border-radius: 6px; z-index: 99; line-height: initial; background: #fff; transition: 0.3s all ease; position: absolute; bottom: 30px; left: 242px; border: 1px solid #eee; padding: 5px; text-align: center; }
.job-thumb .active {opacity: 1; visibility: visible; margin: 75px 0 0 0;}
.hidden {display: none;}
#shareMenu {border: 1px solid #ccc; padding: 10px; position: absolute; background-color: white; margin-top: 120px; margin-left: 128px; z-index: 111;}
</style>