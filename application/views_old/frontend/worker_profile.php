<?php
if (!empty($user_detail->backgroundPic) && file_exists('uploads/users/background/' . $user_detail->backgroundPic)) {
    $banner_img=base_url("uploads/users/background/".$user_detail->backgroundPic);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<section style="width: 100%; height: 200px;">
    <div style="width: 100%; height: 100%; position: relative;">
        <div style="background: #c34e102b; position: absolute; z-index: 1; width: 100%; height: 100%;"></div>
        <img style="width: 100%; height: 100%; object-fit: cover;" src="<?= $banner_img ?>" />
    </div>
</section>

<section class="overlape freelancer-details-page">
    <div class="block remove-top Worker_Detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <div class="cand-single-user"> -->
                    <div class="worker_cand-single-user">
                        <div class="row m-0">
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div class="can-detail-s">
                                    <div class="cst">
                                        <?php if(!empty($user_detail->profilePic)&& file_exists('uploads/users/'.@$user_detail->profilePic)){?>
                                        <img src="<?= base_url('uploads/users/'.@$user_detail->profilePic)?>" alt="" />
                                        <?php } else{?>
                                        <img src="<?= base_url('uploads/no_pimage.png')?>" alt="" />
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-12 Worker_Head_Text">
                                <div class="Worker_Head_Text_Data">
                                    <h3><?php if(!empty($user_detail->firstname)){ echo $name = $user_detail->firstname.' '.$user_detail->lastname;} else { echo $name = $user_detail->username; }?></h3>
                                    <p>Member Since, <?= date('Y',strtotime(@$user_detail->created))?></p>
                                    <!-- <p><i class="la la-map-marker"></i><?= @$user_detail->address?></p> -->
                                </div>
                                <?php if(@$_SESSION['afrebay']['userId'] != $user_detail->userId) { ?>
                                <div id="status-options">
                                    <?php if(!empty(@$_SESSION['afrebay']['userId'])) {
                                    $checkMuteUser = $this->db->query("SELECT * FROM mute_user WHERE to_user_id = '".$user_detail->userId."' AND from_user_id = '".$_SESSION['afrebay']['userId']."'")->row();
                                    //print_r($checkMuteUser);
                                    if(@$checkMuteUser->status == "1") { ?>
                                    <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 13px; display: inline-block;" onclick="unmuteUser(<?= $user_detail->userId ?>)"><i class="las la-volume-up"></i> Unmute</a>
                                    <?php } else { ?>
                                    <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 13px; display: inline-block;" onclick="muteUser(<?= $user_detail->userId ?>)"><i class="las la-volume-off"></i> Mute</a>
                                    <?php } } else { ?>
                                    <a href="<?php echo base_url()?>login" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 10px; display: inline-block;"><i class="las la-volume-off"></i> Mute</a>
                                    <?php } ?>
                                    <?php if(!empty(@$_SESSION['afrebay']['userId'])) {
                                    $checkreportUser = $this->db->query("SELECT * FROM report_user WHERE to_user_id = '".$user_detail->userId."' AND from_user_id = '".$_SESSION['afrebay']['userId']."'")->row();
                                    //print_r($checkreportUser);
                                    if(!empty($checkreportUser)) { ?>
                                    <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 13px; display: inline-block;"><i class="la la-flag"></i> Reported</a>
                                    <?php } else { ?>
                                    <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 13px; display: inline-block;" onclick="report(<?= $user_detail->userId ?>)"><i class="la la-flag"></i> Report</a>
                                    <?php } } else { ?>
                                    <a href="<?php echo base_url()?>login" style="background: #fa8558; padding: 6px; border-radius: 5px; color: #fff; font-size: 13px; display: inline-block;"><i class="la la-flag"></i> Report</a>
                                    <?php } ?>

                                    <a href="javascript:void(0)" style="background: #2892ff; padding: 6px; border-radius: 5px; color: #fff; font-size: 13px; display: inline-block;" id="shareBtn"><i class="la la-share"></i> Forward </a>
                                </div>
                                <div id="shareMenu" class="hidden">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('professionals_detail/' . base64_encode(@$user_detail->userId)) ?>" target="_blank" class="fa-brands fa-facebook"></a>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo $post_data->post_title; ?>&url=<?= base_url('professionals_detail/' . base64_encode(@$user_detail->userId)) ?>" target="_blank" class="fa-brands fa-twitter"></a>
                                    <a href="mailto:?subject=<?php echo $name; ?>&body=<?= 'I found this interesting: '.base_url('professionals_detail/' . base64_encode(@$user_detail->userId)) ?>" target="_blank" class="fa-brands fa-google"></a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= base_url('professionals_detail/' . base64_encode(@$user_detail->userId)) ?>" target="_blank" class="fa-brands fa-linkedin"></a>
                                    <a href="https://www.instagram.com/?url=<?= base_url('professionals_detail/' . base64_encode(@$user_detail->userId)) ?>" target="_blank" class="fa-brands fa-instagram"></a>
                                    <a href="https://api.whatsapp.com/send?text=<?php echo $post_data->post_title; ?> <?= base_url('professionals_detail/' . base64_encode(@$user_detail->userId)) ?>" target="_blank" class="fa-brands fa-whatsapp"></a>
                                    <a href="https://telegram.me/share/url?url=<?= base_url('professionals_detail/' . base64_encode(@$user_detail->userId)) ?>&text=<?php echo $post_data->post_title; ?>" target="_blank" class="fa-brands fa-telegram"></a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                    <ul class="cand-extralink">
                        <li><a href="#about" title="">About</a></li>
                        <li><a href="#education" title="">Education</a></li>
                        <li><a href="#experience" title="">Work Experience</a></li>
                        <li><a href="#skills" title="">Professional Skill Set</a></li>
                    </ul>
                    <div class="cand-details-sec">
                        <div class="row">
                            <div class="col-lg-8 column">
                                <div class="cand-details" id="about">
                                    <h2>About This Professional</h2>
                                    <p>
                                        <?= @$user_detail->short_bio;?>
                                    </p>

                                    <div class="edu-history-sec" id="education">
                                        <h2>Business Details</h2>
                                        <div class="edu-history">
                                            <i class="la la-graduation-cap"></i>
                                            <div class="edu-hisinfo">
                                                <h6 class="mb-1 font-weight-bold text-dark text-uppercase">Company Name: <?= ucfirst($user_detail->companyname); ?></h6>
                                                <p><span class="font-weight-bold">Address:</span> <?= ucfirst($user_detail->address); ?></p>
                                                <p><span class="font-weight-bold">Servide Type: </span> <?= ucfirst($user_detail->serviceType); ?></p>
                                                <p><span class="font-weight-bold">Contact No. :</span> <?= ucfirst($user_detail->mobile); ?></p>
                                                <p><span class="font-weight-bold">Hourly Rate:</span> <?= ucfirst($user_detail->hourly_rate); ?></p>
                                                <p style="word-break: break-all;"><span class="font-weight-bold">Referrence Link:</span> <a href="<?= ucfirst($user_detail->reference_link); ?>" target="_blank" class="bg-primary text-white py-2 px-4 rounded">View</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edu-history-sec" id="experience" style="padding: 19px !important;">
                                        <h2>Work Sample</h2>
                                        <?php if(!empty($user_work)) { ?>
                                        <div class="profileImgBox">
                                            <?php foreach ($user_work as $sample) {
                                            $extension = strtolower(pathinfo($sample->work_sample, PATHINFO_EXTENSION));
                                            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) { ?>
                                            <img src="<?= base_url('uploads/users/work_sample/'.$sample->work_sample); ?>" alt="Image" style="width: 182px;height: auto;">
                                            <?php } elseif (in_array($extension, ['mp4', 'webm', 'avi', 'mov'])) { ?>
                                            <video width="165" height="110" controls>
                                            <source src="<?= base_url('uploads/users/work_sample/'.$sample->work_sample); ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                            </video>
                                            <?php } else { ?>
                                            <p>Unsupported file type</p>
                                            <?php } } ?>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <?php if(!empty($user_detail->skills)) { ?>
                                    <div class="progress-sec" id="skills">
                                        <!-- <h2>Professional Skill Set</h2> -->
                                        <h2>Specializations</h2>
                                        <div class="progress-sec" style="text-transform: uppercase;">
                                            <span><?= @$user_detail->skills ?></span>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-4 column">
                                <div class="job-overview">
                                    <h3 class="text-uppercase">Candidate Overview</h3>
                                    <ul>
                                        <li>
                                            <i class="la la-mars-double"></i>
                                            <h3>Gender</h3>
                                            <span><?= @$user_detail->gender?></span>
                                        </li>
                                        <!-- <li>
                                            <i class="la la-shield"></i>
                                            <h3>Experience</h3>
                                            <span><?= @$user_detail->experience?></span>
                                        </li> -->
                                    </ul>
                                </div>
                                <!-- Job Overview -->
                                <?php if(!empty($_SESSION['afrebay']['userId'])&& $_SESSION['afrebay']['userType']==2){?>
                                <div class="quick-form-job">
                                    <h3>Rate This Professional</h3>
                                    <form method="post" action="<?= base_url('user/dashboard/save_employer_rating')?>">
                                        <div class="row m-0">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span class="star-rating star-5">
                                                    <input type="radio" name="rating" value="1"><i></i>
                                                    <input type="radio" name="rating" value="2"><i></i>
                                                    <input type="radio" name="rating" value="3"><i></i>
                                                    <input type="radio" name="rating" value="4"><i></i>
                                                    <input type="radio" name="rating" value="5"><i></i>
                                                </span>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 Form_Subject">
                                                <input type="text" placeholder="Enter Subject" name="subject"
                                                    required />
                                                <input type="hidden" value="<?= @$user_detail->userId ?>"
                                                    name="user_id">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 Form_Textarea">
                                                <textarea placeholder="Enter review" name="review"></textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 Form_Btn">
                                                <button class="submit btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                        <!--  <span>You accepts our <a href="javascript:void(0)" title="">Terms and Conditions</a></span> -->
                                    </form>
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
<style>
#status-options {border-radius: 6px; z-index: 99; line-height: initial;  transition: 0.3s all ease; position: absolute; bottom: 15px; left: 15px; border: 1px solid #eee; padding:0px; text-align: center; }
.job-thumb .active {opacity: 1; visibility: visible; margin: 75px 0 0 0;}
.hidden {display: none;}
#shareMenu {border: 1px solid #ccc; padding: 10px; position: absolute; background-color: white; bottom: -25px; left: 145px; z-index: 111;}
#shareMenu a{
    padding: 0 5px;
}
</style>
<script>
$(document).ready(function() {
    const shareBtn = $('#shareBtn');
    const shareMenu = $('#shareMenu');
    shareBtn.click(function() {
        shareMenu.toggle();
    });
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