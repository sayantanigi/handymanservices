<?php
function get_time_ago($time) {
    $time_ago = time() - $time;
    if ($time_ago < 60) {
        return $time_ago . ' second ago';
    }
    $minutes = floor($time_ago / 60);
    if ($minutes < 60) {
        return $minutes . ' minutes ago';
    }
    $hours = floor($time_ago / 3600);
    if ($hours < 24) {
        return $hours . ' hours ago';
    }
    $days = floor($time_ago / 86400);
    if ($days < 7) {
        return $days . ' days ago';
    }
    $weeks = floor($time_ago / 604800);
    if ($weeks < 4) {
        return $weeks . ' weeks ago';
    }
    $months = floor($time_ago / 2628000); // Approximate value
    if ($months < 12) {
        return $months . ' months ago';
    }
    $years = floor($time_ago / 31536000); // Approximate value
    return $years . ' years ago';
}
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 990px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Current Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="pf-map" id="map"></div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="block Opp_Block pb-4 pt-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 order-lg-2">
                    <div class="fixdPosthead sticky-top">
                        <div class="createPost mb-3" <?php if (!empty($_SESSION['afrebay']['userType'])) { echo ""; } else {echo 'onclick="forguestAlert()"'; }?> >
                            <div class="d-flex">
                                <div class="crpostUser mr-3">
                                    <?php
                                    $getUser_details = $this->db->query("SELECT * FROM users WHERE userId = '" . $_SESSION['afrebay']['userId'] . "'")->row();
                                    if (!empty($getUser_details->profilePic) && file_exists('uploads/users/' . $getUser_details->profilePic)) {
                                        $profilePic = base_url('uploads/users/' . $getUser_details->profilePic);
                                    } else {
                                        $profilePic = base_url('uploads/no_pimage.png');
                                    }
                                    ?>
                                    <img src="<?= $profilePic; ?>">
                                </div>
                                <div class="flex-fill w-100">
                                    <div class="postType">
                                        <form method="post" action="<?php echo base_url('Welcome/save_postjob') ?>" enctype="multipart/form-data" style="padding: 0 !important;" id="generalForm">
                                            <textarea name="post_title" id="post_title" class="typePost emoji_act" placeholder="Post your task"></textarea>
                                            <button class="submitpost" type="submit">Post</button>
                                            <input type="hidden" name="user_id" value="<?php echo @$_SESSION['afrebay']['userId'] ?>">
                                            <input type="hidden" name="location" id="location" value="<?= @$loc ?>" placeholder="Set Location" />
                                            <input type="hidden" id="search_lat" name="s_lat" value="<?= @$lat ?>">
                                            <input type="hidden" id="search_lon" name="s_lon" value="<?= @$lon ?>">
                                            <input type="hidden" id="cat_value" name="cat_value" value="">
                                            <select name="category" id="category" class="categories_style" onchange="getcategoryval(this.value);" required style="position: absolute; margin-left: 26rem;">
                                                <option value="">Select Category</option>
                                                <?php
                                                $getCategory = $this->db->query("SELECT * FROM category WHERE status = 'Active'")->result_array();
                                                if(!empty($getCategory)) {
                                                foreach($getCategory as $item) { ?>
                                                <option value="<?= $item['id'] ?>"><?= ucfirst($item['category_name'])?></option>
                                                <?php } }?>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="uploadOptionPost">
                                        <div data-toggle="modal" <?php if (!empty($_SESSION['afrebay']['userType'])) { echo 'data-target="#postModal" onclick="postData()"'; } else { echo ''; } ?>>
                                            <label id="postBoximgup"><img src="<?php base_url(); ?>assets/images/photo-icon.png"> Image</label>
                                            <label id="postBoxvidup"><img src="<?php base_url(); ?>assets/images/video-icon.png"> Video</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content posttabcontent" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-local" role="tabpanel" aria-labelledby="pills-local-tab">
                            <div id="loader" style="position: absolute; width: 96%; z-index: 1; background: #00000054; border-radius: 20px;" class="d-none">
                                <!-- <div style="border-radius: 20px; height: 765px; text-align: center; position: relative; top: 10pc;">
                                    <img src="<?= base_url('assets/images/loader.gif'); ?>" style=" width: 200px; ">
                                </div> -->
                            </div>
                            <div class="PostContainer boxPost">
                            <!-- Single Post -->
                            <?php
                            if (!empty($get_post)) {
                                foreach ($get_post as $row) {
                                $get_user = $this->db->query("SELECT * FROM users WHERE userId = '$row->user_id'")->row(); ?>
                                <div class="DataContainer postblockElement">
                                    <!-- <div id="loader_<?= $row->id ?>" style="background: #21252954;position: absolute;width: 96%;text-align: center;margin-top: 0px;border-radius: 20px;" class="d-none">
                                        <img src="<?= base_url('assets/images/loader.gif'); ?>" style="padding: 122px;">
                                    </div> -->
                                    <div class="boxuppost">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="InfoBlock" style="display: flex; flex-direction: row; height: 70px; align-items: center; justify-content: flex-start;">
                                                <?php if (!empty($get_user->profilePic) && file_exists('uploads/users/' . $get_user->profilePic)) { ?>
                                                <img style="width:70px; height: 70px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/users/<?= $get_user->profilePic ?>" alt="">
                                                <?php } else { ?>
                                                <img style="width: 70px; height: 70px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/no_pimage.png" alt="">
                                                <?php } ?>
                                                <div class="TextData" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center; padding-left: 15px;">
                                                    <a href="<?php if($get_user->userType == '1') {echo base_url('professionals_detail/'.base64_encode($get_user->userId)); } else{ echo base_url('customer_detail/'.base64_encode($get_user->userId)); }?>">
                                                        <h3 style="font-size: 20px; font-weight: 600; margin: 0; color: #000;"><?php echo "@".$get_user->username; ?></h3>
                                                    </a>
                                                    <p style="margin: 0; font-size: 13px; color: #b1b1b1;">Posted <?php echo get_time_ago(strtotime($row->created_date)) ?> </p>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="btn-group dropleft dropPost">
                                                    <a class="dotsdrop" href="#" role="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu  dropdown-menu-lg-right">
                                                        <!-- <a class="dropdown-item" href="<?= base_url() ?>update-postjob/<?= base64_encode($row->id) ?>">Edit Post</a> -->
                                                        <?php if (@$_SESSION['afrebay']['userId'] === @$row->user_id) { ?>
                                                        <a class="dropdown-item PostItem" href="javascript:void(0)" onclick="jobDelete(<?= $row->id ?>)"><img src="<?= base_url('assets/images/PostIcon7.png'); ?>">Delete Post</a>
                                                        <?php } ?>
                                                        <?php
                                                        $getsavepostData = $this->db->query("SELECT * FROM users_save_post WHERE post_id = '".$row->id."' AND user_id = '".$_SESSION['afrebay']['userId']."' AND status = '1'")->row();
                                                        if (!empty($getsavepostData)) { ?>
                                                        <a class="dropdown-item PostItem" href="javascript:void(0)" onclick="unsavePost(<?= $row->id ?>)"><img src="<?= base_url('assets/images/bookmark.png'); ?>"> Unsave Post</a>
                                                        <?php } else { ?>
                                                        <a class="dropdown-item PostItem" href="javascript:void(0)" onclick="savePost(<?= $row->id ?>)"><img src="<?= base_url('assets/images/PostIcon8.png'); ?>"> Save Post</a>
                                                        <?php } ?>
                                                        <a class="dropdown-item PostItem"><img src="<?= base_url('assets/images/PostIcon9.png'); ?>"> Forward Post</a>
                                                        <a class="dropdown-item PostItem"><img src="<?= base_url('assets/images/PostIcon10.png'); ?>"> Not interested in this post</a>
                                                        <a class="dropdown-item PostItem"><img src="<?= base_url('assets/images/PostIcon4.png'); ?>"> Follow @Username</a>
                                                        <a class="dropdown-item PostItem"><img src="<?= base_url('assets/images/Postadd2.png'); ?>"> Add/remove @Username from Lists</a>
                                                        <a class="dropdown-item PostItem"><img src="<?= base_url('assets/images/PostIcon3.png'); ?>"> Mute @Username</a>
                                                        <a class="dropdown-item PostItem"><img src="<?= base_url('assets/images/PostIcon1.png'); ?>"> Block @Username</a>
                                                        <a class="dropdown-item PostItem"><img src="<?= base_url('assets/images/PostIcon5.png'); ?>"> Embed Post</a>
                                                        <a class="dropdown-item PostItem"><img src="<?= base_url('assets/images/PostIcon6.png'); ?>"> Report Post</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="CommentData" style="margin-top: 15px;margin-bottom:8px;font-size: 14px;color: #000;line-height: 25px;"> <?= ucfirst($row->post_title)?></p>
                                        <?php if(!empty($row->category_id)) {
                                            $get_category = $this->db->query("SELECT * FROM category WHERE id = '".$row->category_id."'")->row();
                                        } ?>
                                        <p class="CommentData" style="margin-top: 8px;margin-bottom: 8px;font-size: 14px;color: #2892ff;line-height: 18px;"> <?= "#".ucfirst(str_replace(' ', '', $get_category->category_name)) ?></p>
                                        <div class="imageData">
                                            <?php
                                            $getImage = $this->db->query("SELECT * FROM postjob_image WHERE job_id = '" . $row->id . "'")->result_array();
                                            $max_display = 4;
                                            $total_image = count($getImage);
                                            //echo "<pre>"; print_r($getImage);
                                            for ($i = 0; $i < min($total_image, $max_display); $i++) { ?>
                                            <div class="box-image<?php if ($total_image > 4) { echo $max_display; } else { echo $total_image; } ?>">
                                                <?php
                                                $extension = strtolower(pathinfo($getImage[$i]['job_image'], PATHINFO_EXTENSION));
                                                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) { ?>
                                                <img src="<?php base_url() ?>uploads/postjob/<?= $getImage[$i]['job_image'] ?>" class="postImageData">
                                                <?php if ($i === $max_display - 1 && $total_image > $max_display) { ?>
                                                <div class="extra-images">+<?php echo $total_image - $max_display ?></div>
                                                <?php }
                                                } elseif (in_array($extension, ['mp4', 'webm', 'avi', 'mov'])) { ?>
                                                <video width="100%" controls> <source src="<?= base_url('uploads/postjob/' . $getImage[$i]['job_image']); ?>" type="video/mp4"> Your browser does not support the video tag. </video>
                                                <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name="postjobID" id="postjobID" value="<?= $row->id ?>">
                                        <input type="hidden" name="userID" id="userID" value="<?= @$_SESSION['afrebay']['userId'] ?>">
                                        <div class="Rply_Comment_Block" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                                            <div class="Active_Icon_Block" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; width: 50%; ">
                                                <?php
                                                if (!empty(@$_SESSION['afrebay']['userType'])) {
                                                $chechis_like = $this->db->query("SELECT * FROM postjob_like WHERE postjob_id = '" . $row->id . "' AND user_id = '" . @$_SESSION['afrebay']['userId'] . "' AND is_liked = 1")->num_rows();
                                                if ($chechis_like > 0) { ?>
                                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="dislikepostjob(<?= $row->id ?>)">
                                                    <span><i class="fa fa-heart" aria-hidden="true"></i></span>
                                                <?php } else { ?>
                                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="likepostjob(<?= $row->id ?>)">
                                                    <span><i class="fa-regular fa-heart"></i></span>
                                                <?php }
                                                } else { ?>
                                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="forguestAlert()">
                                                    <span><i class="fa-regular fa-heart"></i></span>
                                                <?php } ?>
                                                <?php $getLikeCount = $this->db->query("SELECT COUNT(id) as count FROM postjob_like WHERE postjob_id = '" . $row->id . "' AND is_liked = 1")->row(); ?>
                                                <p style="margin: 0; margin-left: 5px; font-size: 14px; font-weight: 500; "><?= $getLikeCount->count ?> </p>
                                                </a>
                                                <a href="#" class="Icon_2" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; margin-left: 20px;">
                                                    <span><i class="fa-regular fa-comment-dots"></i></span>
                                                    <?php $getCommentCount = $this->db->query("SELECT COUNT(id) as count FROM postjob_comment WHERE postjob_id = '" . $row->id . "'")->row(); ?>
                                                    <p style="margin: 0; margin-left: 5px; font-size: 15px; font-weight: 500;"> <?= $getCommentCount->count; ?> </p>
                                                </a>
                                            </div>
                                            <ul
                                                style="margin: 0; display: flex; align-items: center; justify-content: flex-end; flex-direction: row; width: 250px; float: right;">
                                                <li class="mb-0" onclick="onclickShare(<?= $row->id ?>)">
                                                    <a href="javascript:void(0)" class="shareBtn1"> <i class="fa-solid fa-share"></i> Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="shareMenu_<?= $row->id ?>" class="hidden shareMenu">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('workdetail/' . base64_encode($row->id)) ?>"
                                                target="_blank"><i class="fa-brands fa-facebook"></i></a>
                                            <a href="https://twitter.com/intent/tweet?text=<?php echo $row->post_title; ?>&url=<?= base_url('workdetail/' . base64_encode($row->id)) ?>"
                                                target="_blank"><i class="fa-brands fa-square-x-twitter"></i></a>
                                            <a href="mailto:?subject=<?php echo $row->post_title; ?>&body=<?= 'I found this interesting: ' . base_url('workdetail/' . base64_encode($row->id)) ?>"
                                                target="_blank"><i class="fa-solid fa-envelope"></i></a>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= base_url('workdetail/' . base64_encode($row->id)) ?>"
                                                target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                                            <a href="https://www.instagram.com/?url=<?= base_url('workdetail/' . base64_encode($row->id)) ?>"
                                                target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                            <a href="https://api.whatsapp.com/send?text=<?php echo $row->post_title; ?> <?= base_url('workdetail/' . base64_encode($row->id)) ?>"
                                                target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                                            <a href="https://telegram.me/share/url?url=<?= base_url('workdetail/' . base64_encode($row->id)) ?>&text=<?php echo $row->post_title; ?>"
                                                target="_blank"><i class="fa-brands fa-telegram"></i></a>
                                        </div>
                                    </div>
                                                <!-- Comment Btn -->
                                                <!-- Comment Data -->
                                                <?php
                                                $getpostComment = $this->db->query("SELECT * FROM postjob_comment WHERE postjob_id = '" . @$row->id . "'")->result_array();
                                                if (!empty($getpostComment)) {
                                                    $i = 1;
                                                    foreach ($getpostComment as $each) {
                                                        $rplycount = $this->db->query("SELECT COUNT(id) as count FROM postjob_comment_like  WHERE postjob_id = '" . @$row->id . "' AND comment_id = '" . $each['id'] . "' AND is_liked = 1")->row();
                                                        ?>
                                                        <div class="Comment_Block replyComment">
                                                            <div class="Comment_Block_Container"
                                                                style="flex-direction: row; align-items: flex-start; justify-content: flex-start; display: flex; width: 100%;">
                                                                <div class="Comment_Img" style="min-width: 50px;">
                                                                    <?php
                                                                    $userData = $this->db->query("SELECT * FROM users WHERE userId = '" . $each['user_id'] . "'")->row();
                                                                    if (!empty($userData->profilePic) && file_exists('uploads/users/' . $userData->profilePic)) { ?>
                                                                        <img style="width: 45px; height: 45px; border-radius: 100%; object-fit: cover;"
                                                                            src="<?= base_url() ?>uploads/users/<?= $userData->profilePic ?>"
                                                                            alt="User Profile">
                                                                    <?php } else { ?>
                                                                        <img style="width: 45px; height: 45px; border-radius: 100%; object-fit: cover;"
                                                                            src="<?= base_url() ?>uploads/no_pimage.png" alt="User Profile">
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="User_Comment_Data"
                                                                    style="width: 92%; display: flex; flex-direction: column;">
                                                                    <div class="replyPost">
                                                                        <p style="margin: 0; font-weight: 600; color: #000 !important;">
                                                                            <?php
                                                                            if (!empty($userData->companyname)) {
                                                                                echo $userData->companyname;
                                                                            } else {
                                                                                echo $userData->firstname . " " . $userData->lastname;
                                                                            }
                                                                            ?> .
                                                                            <span
                                                                                style=" color: #6a6a6a; font-weight: 400;"><?php echo get_time_ago(strtotime($each['created_at'])) ?></span>

                                                                        </p>
                                                                        <p style="margin-bottom: 0; "><?= $each['comment']; ?></p>
                                                                    </div>
                                                                    <ul
                                                                        style="margin: 0; display: flex; align-items: center; justify-content: flex-start; margin-top: 10px;">
                                                                        <li
                                                                            style="margin: 0 25px 0 0 !important; font-size: 14px; color: #000 !important; font-weight: 600;">
                                                                            <?php if (!empty(@$_SESSION['afrebay']['userType'])) {
                                                                                $checkrplycount = $this->db->query("SELECT * FROM postjob_comment_like WHERE user_id = '" . @$_SESSION['afrebay']['userId'] . "' AND postjob_id = '" . @$row->id . "' AND comment_id = '" . $each['id'] . "' AND is_liked = 1")->row();
                                                                                if ($checkrplycount > 0) { ?>
                                                                                    <a style="color: #000 !important;" href="javascript:void(0)"
                                                                                        onclick="dislikeuserrply(<?= $row->id ?>, <?= $each['id'] ?>)"><i
                                                                                            class="fa fa-heart" aria-hidden="true"></i></a>
                                                                                <?php } else { ?>
                                                                                    <a style="color: #000 !important;" href="javascript:void(0)"
                                                                                        onclick="likeuserrply(<?= $row->id ?>, <?= $each['id'] ?>)"><i
                                                                                            class="fa-regular fa-heart"></i></a>
                                                                                <?php }
                                                                            } else { ?>
                                                                                <a style="color: #000 !important;"
                                                                                    href="<?= base_url() ?>login"><i
                                                                                        class="fa-regular fa-heart"></i></a>
                                                                            <?php } ?>
                                                                        </li>
                                                                        <?php if (!empty(@$_SESSION['afrebay']['userType'])) { ?>
                                                                            <li
                                                                                style="margin: 0 !important; font-size: 13px; color: #000 !important; font-weight: 600;">
                                                                                <a style="color: #000 !important;" href="javascript:void(0)"
                                                                                    onclick="replylink(<?= $row->id; ?>, <?= $each['id']; ?>)"><i
                                                                                        class="fa-sharp fa-regular fa-reply-all"></i></a>
                                                                            </li>
                                                                        <?php } else { ?>
                                                                            <li
                                                                                style="margin: 0 !important; font-size: 13px; color: #000 !important; font-weight: 600;">
                                                                                <a style="color: #000 !important;"
                                                                                    href="<?= base_url() ?>login"><i
                                                                                        class="fa-sharp fa-regular fa-reply-all"></i></a>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                    <!-- <div style="height: 148px; overflow-y: scroll;"> -->
                                                                    <?php
                                                                    $commentRply = $this->db->query("SELECT * FROM postjob_comment_rply WHERE comment_id = '" . $each['id'] . "'")->result_array();
                                                                    if (!empty($commentRply)) {
                                                                        foreach ($commentRply as $rply) {
                                                                            $userDataRply = $this->db->query("SELECT * FROM users WHERE userId = '" . $rply['user_id'] . "'")->row(); ?>
                                                                            <div class="replyPost mt-2" style="margin-left: 30px;">
                                                                                <p style="font-weight: 600;color: #000 !important;">
                                                                                    <?php
                                                                                    if (!empty($userDataRply->companyname)) {
                                                                                        echo $userDataRply->companyname;
                                                                                    } else {
                                                                                        echo $userDataRply->firstname . " " . $userDataRply->lastname;
                                                                                    }
                                                                                    ?> .
                                                                                    <span
                                                                                        style="font-size: 13px; color: #6a6a6a; font-weight: 400;"><?php echo get_time_ago(strtotime($rply['created_at'])) ?></span>
                                                                                </p>
                                                                                <p><?= $rply['comment']; ?></p>
                                                                            </div>
                                                                        <?php }
                                                                    } ?>
                                                                    <!-- </div> -->
                                                                    <div class="replyBox mt-3" id="replyBox_<?= $each['id']; ?>">
                                                                        <textarea required="" name="users_rply_<?= $each['id']; ?>" id="users_rply_<?= $each['id']; ?>" placeholder="Reply"></textarea>
                                                                        <a href="javascript:void(0)" class="replySubmit" onclick="postUserComment(<?= $row->id; ?>, <?= $each['id']; ?>)"> Reply </a>
                                                                        <div class="uploadOptionPost">
                                                                            <div data-toggle="modal" style="margin-top: 20px;">
                                                                                <label id="postBoximgup"><img src="assets/images/photo-icon.png"> Image</label>
                                                                                <label id="postBoxvidup"><img src="assets/images/video-icon.png"> Video</label>
                                                                                <!-- <input type="file" id="file-upload" name="postjobPic[]" multiple class="text-center center-block file-upload" /> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $i++;
                                                    }
                                                } ?>
                                                <div class="boxdownpost">
                                                    <div class="d-flex">
                                                        <div class="commnetUser">
                                                            <img
                                                                src="<?= base_url()?>uploads/no_pimage.png">
                                                        </div>
                                                        <div class="Comment_Mobile position-relative flex-fill w-100">
                                                            <textarea class="postComment mt-0 form-control f1 emoji_act"
                                                                type="text" placeholder="Enter your comments"
                                                                name="comment_<?= $row->id ?>"
                                                                id="comment_<?= $row->id ?>"></textarea>
                                                            <div>
                                                                <?php if (!empty(@$_SESSION['afrebay']['userType'])) { ?>
                                                                    <a href="javascript:void(0)" class="postCommentbtn"
                                                                        onclick="postComment(<?= $row->id ?>)">
                                                                        <span>Comment</span>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href="<?= base_url() ?>login" class="postCommentbtn">
                                                                        <span>Comment</span>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="uploadOptionPost" style="margin-top: 20px;">
                                                                <div data-toggle="modal">
                                                                    <label id="postBoximgup"><img src="assets/images/photo-icon.png"> Image</label>
                                                                    <label id="postBoxvidup"><img src="assets/images/video-icon.png"> Video</label>
                                                                    <!-- <input type="file" id="file-upload" name="postjobPic[]" multiple class="text-center center-block file-upload" /> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    } else { ?>
                                        <div class="col-12" style=" background: #fff; border-radius: 20px; ">
                                            <div class="boxuppost">No post available</div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- <div class="tab-pane fade" id="pills-global" role="tabpanel" aria-labelledby="pills-global-tab">...</div> -->
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3 order-lg-1">
                        <div class="add-sidebar sticky-top">
                            <?php
                            if (is_numeric($_SESSION['afrebay']['userId'])) {
                                $userData = $this->db->query("SELECT * FROM users WHERE userId = '" . @$_SESSION['afrebay']['userId'] . "'")->row();
                                if (!empty($userData->profilePic) && file_exists('uploads/users/' . $userData->profilePic)) {
                                    $userProfileImage = base_url('uploads/users/' . $userData->profilePic);
                                } else {
                                    $userProfileImage = base_url('uploads/no_pimage.png');
                                }

                                if (!empty($userData->backgroundPic) && file_exists('uploads/users/background/' . $userData->backgroundPic)) {
                                    $userBackgroundImage = base_url('uploads/users/background/' . $userData->backgroundPic);
                                } else {
                                    $userBackgroundImage = base_url('uploads/no_pimage.png');
                                }
                                ?>
                                <div class="ProfileBlock mb-3">
                                    <div class="profilecover">
                                        <img src="<?= $userBackgroundImage ?>">
                                    </div>
                                    <div class="profileImg"><img src="<?= $userProfileImage; ?>"></div>
                                    <h2 style="text-transform: lowercase;"><?= "@".$userData->username; ?>
                                    </h2>
                                    <p class="text-center memberinfo">
                                        <?= 'Member Since ' . date('M Y', strtotime($userData->created)) ?> .
                                        <!-- <?php if ($userData->userType === '1') {
                                            echo "Professional";
                                        } else {
                                            echo "Customer";
                                        } ?> -->
                                    </p>
                                    <div class="profileInfo d-flex justify-content-between text-center" style="display: none !important">
                                        <div>
                                            <h3>
                                                <?php
                                                $countPost = $this->db->query("SELECT COUNT(id) as totalPost FROM postjob WHERE user_id = '" . $userData->userId . "'")->row();
                                                echo $countPost->totalPost;
                                                ?>
                                            </h3>
                                            <h4>Posts</h4>
                                        </div>
                                        <div>
                                            <h3>
                                                <?php
                                                $getPostID = $this->db->query("SELECT GROUP_CONCAT(id) as post_id FROM postjob WHERE user_id = '" . @$userData->userId . "'")->row();
                                                if (!empty($getPostID->post_id)) {
                                                    $commentPost = $this->db->query("SELECT COUNT(id) as total_comment FROM postjob_comment WHERE postjob_id IN (" . @$getPostID->post_id . ")")->row();
                                                    $commentPostrply = $this->db->query("SELECT COUNT(id) as total_commentrply FROM postjob_comment_rply WHERE postjob_id IN (" . @$getPostID->post_id . ")")->row();
                                                } else {
                                                    $commentPost = 0;
                                                    $commentPostrply = 0;
                                                }
                                                echo $total_comment = ($commentPost->total_comment + $commentPostrply->total_commentrply);
                                                ?>
                                            </h3>
                                            <h4>Comments</h4>
                                        </div>
                                        <div>
                                            <h3>
                                                <?php
                                                if (!empty($getPostID->post_id)) {
                                                    $getPostLike = $this->db->query("SELECT COUNT(id) as total_like FROM postjob_like WHERE postjob_id IN (" . $getPostID->post_id . ")")->row();
                                                    echo $getPostLike->total_like;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </h3>
                                            <h4>Likes</h4>
                                        </div>
                                        <div>
                                            <h3>
                                                <?php
                                                // if($_SESSION['afrebay']['userType'] == "2") {
                                                //     echo "SELECT COUNT(id) as review FROM employer_rating WHERE worker_id = '".$_SESSION['afrebay']['userId']."'";
                                                //     $getreview = $this->db->query("SELECT COUNT(id) as review FROM employer_rating WHERE worker_id = '".$_SESSION['afrebay']['userId']."'")->row();
                                                // } else {
                                                //     echo "SELECT COUNT(id) as review FROM employer_rating WHERE employer_id = '".$_SESSION['afrebay']['userId']."'";
                                                //     $getreview = $this->db->query("SELECT COUNT(id) as review FROM employer_rating WHERE employer_id = '".$_SESSION['afrebay']['userId']."'")->row();
                                                // }
                                                $getreview = $this->db->query("SELECT COUNT(id) as review FROM employer_rating WHERE worker_id = '".$_SESSION['afrebay']['userId']."'")->row();
                                                if (!empty($getreview->review)) {
                                                    echo $getreview->review;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </h3>
                                            <h4>Reviews</h4>
                                        </div>
                                    </div>
                                    <?php
                                    $uid = $_SESSION['afrebay']['userType'];
                                    if (@$_SESSION['afrebay']['userType'] == '1') { ?>
                                        <a href="<?php echo base_url("professionals_detail/" . base64_encode($_SESSION['afrebay']['userId'])) ?>"
                                            title="" class="profileBtn">My Profile</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url("customer_detail/" . base64_encode($_SESSION['afrebay']['userId'])) ?>"
                                            title="" class="profileBtn">My Profile</a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="activityBox mb-3">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="font-weight-bold">Activity</h6>
                                    <!-- <div><a href="#" class="seeall">See All</a></div> -->
                                </div>
                                <?php
                                $getPostData = $this->db->query("SELECT GROUP_CONCAT(id) as id FROM postjob WHERE user_id = '" . $_SESSION['afrebay']['userId'] . "'")->row();
                                if (!empty($getPostData->id)) {
                                    $checkPostLike = $this->db->query("SELECT * FROM postjob_like WHERE postjob_id IN (" . $getPostData->id . ") AND is_liked = '1' AND user_id != '".$_SESSION['afrebay']['userId']."'ORDER BY id DESC")->result_array();
                                    foreach ($checkPostLike as $postLike) {
                                        $getUserDetails = $this->db->query("SELECT * FROM users WHERE userId = '" . $postLike['user_id'] . "'")->row();
                                        if (!empty($getUserDetails->profilePic) && file_exists('uploads/users/' . $getUserDetails->profilePic)) {
                                            $profilePic = base_url() . 'uploads/users/' . $getUserDetails->profilePic;
                                        } else {
                                            $profilePic = base_url() . 'uploads/no_pimage.png';
                                        }
                                        if (!empty($getUserDetails->companyname)) {
                                            $fullname = $getUserDetails->companyname;
                                        } else {
                                            $fullname = $getUserDetails->firstname . ' ' . $getUserDetails->lastname;
                                        }
                                        if ($getUserDetails->userType == '2') {
                                            $link = base_url('customer_detail/' . base64_encode($getUserDetails->userId));
                                        } else {
                                            $link = base_url('professionals_detail/' . base64_encode($getUserDetails->userId));
                                        }
                                        ?>
                                        <div class="d-flex mb-2 activitylist align-items-center">
                                            <div class="activityUser">
                                                <a href="javascript:void(0)"><img src="<?= $profilePic; ?>"></a>
                                            </div>
                                            <div>
                                                <h4><a href="<?= $link; ?>" target="_blank"><span class="font-weight-bold"><?= "@".$getUserDetails->username; ?></span> liked your post.</a></h4>
                                                <p><?php echo get_time_ago(strtotime($postLike['created_at'])) ?></p>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                                <?php
                                $getPostData = $this->db->query("SELECT GROUP_CONCAT(id) as id FROM postjob WHERE user_id = '" . $_SESSION['afrebay']['userId'] . "'")->row();
                                if (!empty($getPostData->id)) {
                                    $checkPostLike = $this->db->query("SELECT * FROM postjob_comment WHERE postjob_id IN (" . $getPostData->id . ") AND user_id != '".$_SESSION['afrebay']['userId']."'ORDER BY id DESC")->result_array();
                                    foreach ($checkPostLike as $postLike) {
                                        $getUserDetails = $this->db->query("SELECT * FROM users WHERE userId = '" . $postLike['user_id'] . "'")->row();
                                        if (!empty($getUserDetails->profilePic) && file_exists('uploads/users/' . $getUserDetails->profilePic)) {
                                            $profilePic = base_url() . 'uploads/users/' . $getUserDetails->profilePic;
                                        } else {
                                            $profilePic = base_url() . 'uploads/no_pimage.png';
                                        }
                                        if (!empty($getUserDetails->companyname)) {
                                            $fullname = $getUserDetails->companyname;
                                        } else {
                                            $fullname = $getUserDetails->firstname . ' ' . $getUserDetails->lastname;
                                        }
                                        if ($getUserDetails->userType == '2') {
                                            $link = base_url('customer_detail/' . base64_encode($getUserDetails->userId));
                                        } else {
                                            $link = base_url('professionals_detail/' . base64_encode($getUserDetails->userId));
                                        }
                                        ?>
                                        <div class="d-flex mb-2 activitylist align-items-center">
                                            <div class="activityUser">
                                                <a href="javascript:void(0)"><img src="<?= $profilePic; ?>"></a>
                                            </div>
                                            <div>
                                                <h4><a href="<?= $link; ?>" target="_blank"><span class="font-weight-bold"><?= "@".$getUserDetails->username; ?></span> commented your post.</a></h4>
                                                <p><?php echo get_time_ago(strtotime($postLike['created_at'])) ?></p>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 order-lg-3">
                        <div class="add-sidebar sticky-top">
                            <?php
                            $getAdSense = $this->db->query("SELECT * FROM adsense WHERE status = 'Active'")->result_array();
                            if (!empty($getAdSense)) {
                                foreach ($getAdSense as $key => $adsense) {
                                    if (!empty($adsense['link'])) {
                                        $link = $adsense['link'];
                                    } else {
                                        $link = '#';
                                    }
                                    if (!empty($adsense['image']) && file_exists('uploads/adsense/' . $adsense['image'])) {
                                        $image = base_url('uploads/adsense/' . $adsense['image']);
                                    } else {
                                        $image = base_url('uploads/no_bimage.png');
                                    } ?>
                                    <a href="<?= $link; ?>" class="mb-3 d-block"><img src="<?= $image; ?>" class="rounded"
                                            style="width: 100%; "></a>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade postMOdal" id="filterModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold text-dark text-center" id="staticBackdropLabel">Post Filters</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body filterContent">
                <h5 class="mb-0 font-weight-bold h6 text-dark text-center">Use filters to find posts on your timeline. </h5>
                <p style="font-size:14px;" class="text-center">This will no affect how others see your timeline.</p>
                <form>
                    <div class="row mb-3 align-items-center justify-content-center">
                        <div class="col-lg-3 col-6">
                            <label>Go to:</label>
                        </div>
                        <div class="col-lg-5 col-6">
                            <select class="form-control" id="year">
                                <?php
                                $startYear = 2000;
                                echo $endYear = date('Y');
                                for ($year = $endYear; $year >= $startYear; $year--) { ?>
                                <option value="<?= $year; ?>"><?= $year; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3  align-items-center justify-content-center">
                        <div class="col-lg-3 col-6">
                            <label>Posted By:</label>
                        </div>
                        <div class="col-lg-5 col-6">
                            <select class="form-control" id="postedBy">
                                <option value="1">Anyone</option>
                                <option value="2">You</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3  align-items-center justify-content-center">
                        <div class="col-lg-3 col-6">
                            <label>Privacy:</label>
                        </div>
                        <div class="col-lg-5 col-6">
                            <select class="form-control" id="privacy">
                                <option value="1">Public</option>
                                <option value="2">Private</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <div class="col-lg-8 col-12">
                            <button class="btn bg-primary w-100" type="button" onclick="searchPost()">Done</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade postMOdal" id="postModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold text-dark text-center" id="staticBackdropLabel">Create
                    Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('Welcome/save_postjob') ?>"
                    enctype="multipart/form-data" style="padding: 0 !important;" id="generalForm1">
                    <div class="postmodalHead d-flex justify-content-between mb-2 align-items-center">
                        <div class="postmodalUser d-flex align-items-center">
                            <div class="modaluserimg">
                                <img src="<?= $profilePic; ?>">
                            </div>
                            <h3 class="mb-0 ml-2 h6 font-weight-bold text-dark"><?= "@".$getUser_details->username; ?></h3>
                        </div>
                        <div class="d-flex selectPost align-items-center">
                            <div><i class="fa-solid fa-earth-americas"></i></div>
                            <select name="visibility" id="visibility">
                                <option value="1">Public</option>
                                <option value="2">Private</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <textarea class="postModalComment post_title emoji_act" name="post_title"
                            placeholder="Enter your post details ..."></textarea>
                    </div>
                    <div class="upload-container mb-2" id="imageUpload">
                        <a href="#" class="closemediaupload"><i class="fa-sharp fa-light fa-xmark"></i></a>
                        <label for="file-upload">
                            <img src="<?php base_url(); ?>assets/images/addPhoto.png" alt="Upload Icon"
                                class="uploadImgicon">
                            <p class="text-dark font-weight-bold">Add photos</p>
                            <p>Images must be less than 5 MB in size</p>
                        </label>
                        <!-- <input type="file" id="file-upload" accept="image/*" > -->
                        <input type="file" id="file-upload" name="postjobPic[]" multiple class="text-center center-block file-upload" />
                    </div>
                    <div class="upload-container mb-2" id="videoUpload">
                        <a href="#" class="closemediaupload"><i class="fa-sharp fa-light fa-xmark"></i></a>
                        <label for="file-upload">
                            <img src="<?php base_url(); ?>assets/images/videoIcon.png" alt="Upload Video" class="uploadImgicon">
                            <p class="text-dark font-weight-bold">Add videos</p>
                            <p>Videos must be less than 25 MB in size</p>
                        </label>
                        <!-- <input type="file" id="file-upload" accept="image/*"> -->
                        <!-- <input type="file" id="file-upload" name="postjobVid[]" multiple class="text-center center-block file-upload" /> -->
                    </div>
                    <div class="d-flex justify-content-between uploadmediaPnl align-items-center mb-2">
                        <div>
                            <h5 class="text-dark mb-0 h6 font-weight-bold">Add to your post</h5>
                        </div>
                        <div class="d-flex uploadinpost align-items-center">
                            <a href="#" id="iconimgupload"><img
                                    src="<?php base_url(); ?>assets/images/iconimageupload.png"></a>
                            <a href="#" id="iconvideoupload"><img
                                    src="<?php base_url(); ?>assets/images/iconvideoupload.png"></a>
                        </div>
                    </div>
                    <div style="background: #F6F6F6; border-radius: 10px; margin-bottom: 15px;">
                        <select name="category" id="category" class="categories_style" style="width: 100%; border-radius: 10px; padding-top: 10px; padding-bottom: 10px; height: 40px;" onchange="getcategoryval(this.value);" required>
                            <option value="">Select Category</option>
                            <?php
                            $getCategory = $this->db->query("SELECT * FROM category WHERE status = 'Active'")->result_array();
                            if(!empty($getCategory)) {
                            foreach($getCategory as $item) { ?>
                            <option value="<?= $item['id'] ?>"><?= ucfirst($item['category_name'])?></option>
                            <?php } }?>
                        </select>
                    </div>
                    <div>
                        <input type="hidden" name="location" id="location_guest" value="<?= @$loc ?>" placeholder="Set Location" />
                        <input type="hidden" name="s_lat" id="search_lat_guest" value="<?= @$lat ?>">
                        <input type="hidden" name="s_lon" id="search_lon_guest" value="<?= @$lon ?>">
                        <input type="hidden" name="cat_valmod" id="cat_valmod" value="">
                        <button class="w-100 postbtn" type="submit">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Choose Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="job-field frmSearch">
                            <input type="text" name="location" id="location" value="<?= @$loc ?>"
                                placeholder="Set Location" />
                            <i class="la la-close" style="right: 0px; top: 19px !important;" onclick="removeAdd()"></i>
                            <input type="hidden" id="search_lat" name="s_lat" value="<?= @$lat ?>">
                            <input type="hidden" id="search_lon" name="s_lon" value="<?= @$lon ?>">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 Mobile_Btn_Container_1">
                        <!-- <button onclick="event.preventDefault(); viewInMap()" style=" width: 100% !important; padding: 18px 0px; height: auto !important; margin: 0; border-radius: 35px !important; font-size: 15px;">View In Map</button> -->
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal"
                            onclick="event.preventDefault(); viewInMap()"
                            style=" width: 100% !important; padding: 18px 0px !important; height: auto !important; margin: 0; border-radius: 35px !important; font-size: 15px;">View
                            In Map</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    #city,#state,.chosen_country{color:#888;height:60px;border-radius:50px;padding:17px!important}
    #city,#state{display:block}
    .jconfirm-content-pane{text-align:center;font-size:18px}
    .jconfirm-buttons{margin-right:140px;display:inline-block}
    #country-list{float:left;list-style:none;margin-top:57px;padding:0;width:100%;position:absolute;z-index:1}
    #country-list li{padding:10px 30px;background:#fff;margin:0!important;border-radius:0;border-bottom:1px solid #eee}
    #country-list li:hover{background:#ece3d2;cursor:pointer}
    ::-webkit-scrollbar{width:10px;background-color:transparent}
    ::-webkit-scrollbar-track{background:0 0}
    ::-webkit-scrollbar-thumb{background:#888;border-radius:5px}
    ::-webkit-scrollbar-thumb:hover{background:#555}
    .pf-map iframe{height:525px!important}
    #map{position:relative!important;height:500px!important;max-width:100%!important}
    .hidereplyBox{display:none!important}
    .showreplyBox{display:block!important}
    @media screen and (max-width:425px) {
        .ADD_Sense,.Comment_Mobile textarea,.Rply_Comment_Block ul,.TopBar a,.TopBar ul,.hidereplyBox a,.hidereplyBox textarea{width:100%!important}
        .TopBar ul li,.job-field input{padding:0 20px!important}
        .job-field .la-search{font-size:25px!important;top:20px!important}
        .Mobile_Btn_Container_1{display:flex;align-items:center;justify-content:center;padding:0!important}
        .Comment_Data,.PostContainer .DataContainer .Comment_Block{padding:10px!important}
        .Mobile_Btn_Container_1 .btn-primary{margin-bottom:20px!important}
        .TopBar{flex-direction:column!important;height:110px!important}
        .TopBar ul{justify-content:space-evenly}.TopBar a span{width:100px!important}
        .PostContainer .DataContainer .InfoBlock{height:50px!important}
        .PostContainer .DataContainer .InfoBlock img{height:50px!important;width:50px!important}
        .PostContainer .DataContainer .InfoBlock .TextData h3{font-size:16px!important}
        .PostContainer .DataContainer .InfoBlock .TextData p{line-height:20px!important}
        .PostContainer .DataContainer .CommentData{font-size:14px!important;line-height:20px!important}
        .Comment_Data{margin-left:0!important}
        .ADD_Sense{height:120px!important;top:calc(100vh - 130px)!important;padding-left:0!important;align-items:center!important;justify-content:center!important;left:0!important}
    }
    .emojionearea,.emojionearea.form-control{border:none!important;box-shadow:none!important}
    .emojionearea .emojionearea-editor:empty:before{text-align:start!important}
    .emojionearea .emojionearea-button.active+.emojionearea-picker-position-bottom{margin-top:37px!important}
    .emojionearea .emojionearea-picker.emojionearea-picker-position-bottom{margin-top:10px!important;right:10px!important;top:47px!important}
    .emojionearea .emojionearea-editor{min-height:3em!important;max-height:0!important}
    .emojionearea .emojionearea-picker .emojionearea-search>input{padding:0 0 0 11px!important;border-radius:8px!important}
    .Comment_Mobile .emojionearea-editor{background:#f4f4f4;font-size:14px!important;margin-bottom:0!important;float:unset!important;padding:10px 105px 10px 20px!important;border-radius:45px!important;min-height:55px!important;margin-top:0!important;width:100%;border:0!important;height:auto!important;background-color:#f4f4f4!important}
    .Comment_Mobile .emojionearea-button{top:45px!important}
    .hidden{display:none}
    .shareMenu{border:1px solid #ccc;padding:5px;background-color:#fff;float:right}
    .PostItem{height:30px;display:flex;padding:0 0 0 10px;align-items:center;justify-content:flex-start}
    .PostItem img{height:16px;width:16px;object-fit:contain;margin-right:5px}
</style>
<script>
$(document).ready(function () {
    var base_url = $("#base_url").val();
    var id = 'United States';
    $.ajax({
        type: "post",
        cache: false,
        url: base_url + "Welcome/states_by_country",
        data: {
            country_name: id
        },
        beforeSend: function () { },
        success: function (returndata) {
            $('.state_field').show();
            $('#state').html(returndata);
            $('#city').html('<option value="">Select State First</option>');
        }
    });
    // $("#search-box").keyup(function () {
    //     var text = $("#search-box").val();
    //     var base_url = $("#base_url").val();
    //     $.ajax({
    //         type: "POST",
    //         url: base_url + "Welcome/get_category_list",
    //         data: {
    //             category_name: text
    //         },
    //         beforeSend: function () {
    //             $("#search-box").css("background", "#FFF url(<?php base_url() ?>uploads/LoaderIcon.gif) no-repeat 165px");
    //         },
    //         success: function (data) {
    //             //console.log(data);
    //             $("#suggesstion-box").show();
    //             $("#suggesstion-box").html(data);
    //             $("#search-box").css("background", "#FFF");
    //         }
    //     });
    // });
    $("#search-box").keyup(function () {
        var text = $("#search-box").val();
        $("#suggesstion-box").show();
        $("#suggesstion-box").html('<ul id="country-list" style="background: white; height: auto; overflow-y: scroll; box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.5);"><li onclick="selectcategory(\'' + text + '\')">'+text+'</li></ul>');
        $("#search-box").css("background", "#FFF");
    });
    $(".emoji_act").emojioneArea({
        emojiPlaceholder: ":smile_cat:",
        searchPlaceholder: "Search",
        buttonTitle: "Use your TAB key to insert emoji faster",
        searchPosition: "bottom",
        pickerPosition: "bottom"
    });
})

$("#generalForm").submit(function () {
    var post_title = $('#post_title').val();
    if (post_title == '') {
        $(".emojionearea-editor").attr("placeholder", "Please Enter Post Title");
        $("emojionearea-editor").prop("required", true);
        $(".emojionearea-editor").focus();
        return false;
    }
});

$("#generalForm1").submit(function () {
    var post_title = $('.emojionearea-editor').text();
    if (post_title == '') {
        $(".emojionearea-editor").attr("placeholder", "Please Enter Post Title");
        $("emojionearea-editor").prop("required", true);
        $(".emojionearea-editor").focus();
        return false;
    }
});

function getState(val) {
    var base_url = $("#base_url").val();
    var id = val;
    $.ajax({
        type: "post",
        cache: false,
        url: base_url + "Welcome/states_by_country",
        data: {
            country_name: id
        },
        beforeSend: function () { },
        success: function (returndata) {
            $('.state_field').show();
            $('#state').html(returndata);
            $('#city').html('<option value="">Select State First</option>');
        }
    });
}

function getCity(val) {
    var base_url = $("#base_url").val();
    var id = val;
    $.ajax({
        type: "post",
        cache: false,
        url: base_url + "Welcome/cities_by_state",
        data: {
            state_name: id
        },
        beforeSend: function () { },
        success: function (returndata) {
            $('.city_field').show();
            $('#city').html(returndata);
        }
    });
}

function viewProfile() {
    $.alert({
        title: '',
        content: "Please login to view professional's profile",
    });
}

function selectcategory(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
    var search_box = $('#search-box').val();
    var base_url = $("#base_url").val();
    var category = $('#category').val();
    var distance = $('#distance').val();
    var search_lat = $('#search_lat').val();
    var search_lon = $('#search_lon').val();;
    $.ajax({
        type: "post",
        cache: false,
        url: base_url + "user/Dashboard/searchPostData",
        data: { search_box: search_box, category: category, distance: distance,search_lat: search_lat, search_lon: search_lon },
        beforeSend: function () {
            $("#loader").removeClass('d-none');
        },
        success: function (data) {
            setTimeout(() => {
                $("#loader").addClass('d-none');
            }, 3000);
            $('.PostContainer').html(data);
        }
    })
}

function getcategorydata(val) {
    var search_box = $('#search-box').val();
    var base_url = $("#base_url").val();
    var category = val;
    var distance = $('#distance').val();
    var search_lat = $('#search_lat').val();
    var search_lon = $('#search_lon').val();;
    $.ajax({
        type: "post",
        cache: false,
        url: base_url + "user/Dashboard/searchPostData",
        data: { search_box: search_box, category: category, distance: distance,search_lat: search_lat, search_lon: search_lon },
        beforeSend: function () {
            $("#loader").removeClass('d-none');
        },
        success: function (data) {
            setTimeout(() => {
                $("#loader").addClass('d-none');
            }, 3000);
            $('.PostContainer').html(data);
        }
    })
}

function getdistancedata(val) {
    var search_box = $('#search-box').val();
    var base_url = $("#base_url").val();
    var category = $('#category').val();
    var distance = val;
    var search_lat = $('#search_lat').val();
    var search_lon = $('#search_lon').val();;
    $.ajax({
        type: "post",
        cache: false,
        url: base_url + "user/Dashboard/searchPostData",
        data: { search_box: search_box, category: category, distance: distance,search_lat: search_lat, search_lon: search_lon },
        beforeSend: function () {
            $("#loader").removeClass('d-none');
        },
        success: function (data) {
            setTimeout(() => {
                $("#loader").addClass('d-none');
            }, 3000);
            $('.PostContainer').html(data);
        }
    })
}

/*$('#search-box').keyup(function() {
    $("#search-box").val();
    $("#suggesstion-box").hide();
    var search_box = $('#search-box').val();
    var base_url = $("#base_url").val();
    var category = $('#category').val();
    var distance = $('#distance').val();
    $.ajax({
        type: "post",
        cache: false,
        url: base_url + "user/Dashboard/searchPostData",
        data: { search_box: search_box, category: category, distance: distance },
        beforeSend: function () { },
        success: function (returndata) {
            $('.search_result').html(returndata);
        }
    })
})*/

function removeAdd() {
    $('#location').val('');
    $('#search_lon').val('');
    $('#search_lat').val('');
}

// for posting Comment
function postComment(postjobID) {
    if ($('#comment_' + postjobID).val() == "") {
        $('#err_comment_' + postjobID).fadeIn().html('Please enter your comment first').css('color', 'red');
        setTimeout(function () {
            $("#err_comment_" + postjobID).html("");
        }, 3000);
        $("#comment_" + postjobID).css('border-color', 'red');
        setTimeout(function () {
            $("#comment_" + postjobID).css('border-color', '#80bdff');
        }, 3000);
        return false;
    } else {
        var user_id = $('#userID').val();
        var postjob_id = postjobID;
        var comment_id = $('#comment_id').val();
        var comment = $('#comment_' + postjobID).val();
        $.ajax({
            url: "<?= base_url() ?>user/dashboard/postComment",
            type: "POST",
            data: {
                user_id: user_id,
                postjob_id: postjob_id,
                comment_id: comment_id,
                comment: comment
            },
            success: function (data) {
                //console.log(data);
                $('.success_msg').text(data);
                $('#comment').val('');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
        })
    }
}

//show/hide reply box
function replylink(postId, commentid) {
    $('#replyBox_' + commentid).toggleClass('showreplyBox');
    //$('#replyBox_' + commentid).removeClass('hidereplyBox');
}

//for user comment's reply
function postUserComment(postId, commentid) {
    if ($('#users_rply_' + commentid).val() == "") {
        $("#users_rply_" + commentid).css('border-color', 'red');
        $('#users_rply_' + commentid).attr("placeholder", "Please type your reply here");
        setTimeout(function () {
            $("#users_rply_" + commentid).css('border-color', '#80bdff');
        }, 3000);
        return false;
    } else {
        var user_id = $('#userID').val();
        var postjob_id = postId;
        var comment_id = commentid;
        var comment = $('#users_rply_' + commentid).val();
        $.ajax({
            url: "<?= base_url() ?>user/dashboard/postUserReply",
            type: "POST",
            data: {
                user_id: user_id,
                postjob_id: postjob_id,
                comment_id: comment_id,
                comment: comment
            },
            success: function (data) {
                //console.log(data);
                $('.success_msg').text(data);
                $('#comment').val('');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
        })
    }
}

// for liking Comment
function likepostjob(postjobID) {
    var user_id = $('#userID').val();
    var postjob_id = postjobID;
    $('.fa-heart-o').css('color', '#000 !important');
    $.ajax({
        url: "<?= base_url() ?>user/dashboard/likepostjob",
        type: "POST",
        data: {
            user_id: user_id,
            postjob_id: postjob_id
        },
        success: function (data) {
            location.reload();
        }
    })
}

// for liking user each Comment
function likeuserrply(postId, commentid) {
    var user_id = $('#userID').val();
    var postjob_id = postId;
    var comment_id = commentid;
    //$('.fa-heart-o').css('color','#000 !important');
    $.ajax({
        url: "<?= base_url() ?>user/dashboard/likeuserrply",
        type: "POST",
        data: {
            user_id: user_id,
            postjob_id: postjob_id,
            comment_id: comment_id
        },
        success: function (data) {
            location.reload();
        }
    })
}

// for disliking Comment
function dislikepostjob(postjobID) {
    var user_id = $('#userID').val();
    var postjob_id = postjobID;
    $('.fa-heart').addClass('fa-heart-o');
    $.ajax({
        url: "<?= base_url() ?>user/dashboard/dislikepostjob",
        type: "POST",
        data: {
            user_id: user_id,
            postjob_id: postjob_id
        },
        success: function (data) {
            console.log(data);
            location.reload();
        }
    })
}

// for disliking Comment
function dislikeuserrply(postId, commentid) {
    var user_id = $('#userID').val();
    var postjob_id = postId;
    var comment_id = commentid;
    //$('.fa-heart').addClass('fa-heart-o');
    $.ajax({
        url: "<?= base_url() ?>user/dashboard/dislikeuserrply",
        type: "POST",
        data: {
            user_id: user_id,
            postjob_id: postjob_id,
            comment_id: comment_id
        },
        success: function (data) {
            console.log(data);
            location.reload();
        }
    })
}

function jobDelete(id) {
    var p_id = id;
    $.confirm({
        title: 'Confirm!',
        content: confirmTextDelete,
        buttons: {
            confirm: function () {
                $.ajax({
                    url: "<?= base_url() ?>user/dashboard/delete_job",
                    method: "POST",
                    data: {
                        id: p_id
                    },
                    beforeSend: function () {
                        $("#loader_" + id).removeClass('d-none');
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == '1') {
                            location.reload(true);
                        } else {
                            location.reload(true);
                        }
                    }

                })
            },
            cancel: function () {
                location.reload();
            },
        }
    });
}

function savePost(p_id, status) {
    $.ajax({
        url: "<?= base_url() ?>user/dashboard/savePost",
        method: "POST",
        data: {p_id: p_id},
        beforeSend: function () {
            ///$("#loader_" + id).removeClass('d-none');
        },
        success: function (data) {
            //console.log(data);
            if (data == '1') {
                location.reload(true);
            } else {
                location.reload(true);
            }
        }
    })
}

function postData() {
    //console.log($('.emojionearea-editor'));
    if ($('.emojionearea-editor').text() != '') {
        $('.emojionearea-editor').text($('.emojionearea-editor').text());
    }
}

function getFeedData(id) {
    var latitude = $('#search_lat').val();
    var longitude = $('#search_lon').val()
    $.ajax({
        url: "<?= base_url() ?>user/dashboard/get_feed_data",
        method: "POST",
        data: {
            id: id,
            latitude: latitude,
            longitude: longitude
        },
        beforeSend: function () {
            $("#loader").removeClass('d-none');
        },
        success: function (data) {
            //console.log(data);
            $("#loader").addClass('d-none');
            // if (data == '1') {
            //     location.reload(true);
            // } else {
            //     location.reload(true);
            // }
            $('.PostContainer').html(data);
        }
    });
}

function searchPost() {
    var year = $('#year').val();
    var postedBy = $('#postedBy').val();
    var privacy = $('#privacy').val();
    $.ajax({
        url: "<?= base_url() ?>user/dashboard/search_post",
        method: "POST",
        data: {
            year: year,
            postedBy: postedBy,
            privacy: privacy
        },
        beforeSend: function () {
            $("#loader").removeClass('d-none');
        },
        success: function (data) {
            //console.log(data);
            $('#filterModal').css('display', 'none');
            $('#filterModal').removeClass('show');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            setTimeout(() => {
                $("#loader").addClass('d-none');
            }, 3000);
            $('.PostContainer').html(data);
        }
    })
}

function onclickShare(id) {
    $('#shareMenu_' + id).toggle();
}

function getcategoryval(id){
    $('#cat_value').val(id);
    $('#cat_valmod').val(id);
}
$('.closemediaupload').click(function () {
    $('.upload-container').hide();
});
$('#postBoximgup').click(function () {
    $('#imageUpload').show();
    $('#videoUpload').hide();
});
$('#iconimgupload').click(function () {
    $('#imageUpload').show();
    $('#videoUpload').hide();
});
$('#postBoxvidup').click(function () {
    $('#videoUpload').show();
    $('#imageUpload').hide();
});
$('#iconvideoupload').click(function () {
    $('#videoUpload').show();
    $('#imageUpload').hide();
});
$('.loginURL').click(function () {
    window.location.href = '<?= base_url() ?>logout';
})
</script>