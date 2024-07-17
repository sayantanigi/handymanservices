<?php
$get_setting=$this->Crud_model->get_single('setting');
$get_category=$this->Crud_model->GetData('category','',"status='Active'");
// print_r($_SESSION);
// if(is_numeric($_SESSION['afrebay']['userId'])){  // return **TRUE** if it is numeric
//     echo "The input is numeric";
// }else{
//     echo "The input is not numeric";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
    <?php
    if(!empty(@$title)) {
        echo $title." - ".@$get_setting->website_name;
    } else {
        echo @$get_setting->website_name;
    }?>
</title>
<?php if($this->uri->segment(1) == 'customer_detail') { ?>
<meta name="description" content="<?php echo @$userdata->short_bio?>">
<?php } else if($this->uri->segment(1) == 'professionals_detail') { ?>
<meta name="description" content="<?php echo @$user_detail->short_bio?>">
<?php } else if($this->uri->segment(1) == 'workdetail') { ?>
<meta name="description" content="<?php echo @$post_data->description?>">
<?php } else if($this->uri->segment(1) == 'about-us') { ?>
<meta name="description" content="">
<?php } else if ($this->uri->segment(1) == 'productdetail') { ?>
<meta name="description" content="<?php echo $prod_details[0]['prod_description']; ?>">
<?php } else if ($this->uri->segment(1) == 'findwork') { ?>
<meta name="description" content="">
<?php } else if ($this->uri->segment(1) == 'career-tips') { $description = explode('.', $get_career->description)?>
<meta name="description" content="<?= $description[0]?>">
<?php } else { ?>
<meta name="description" content="<?php echo @$description?>">
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="<?=base_url(); ?>uploads/logo/<?= $get_setting->favicon?>" />
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap-grid.css" />
<link rel="stylesheet" href="<?=base_url(); ?>assets/css/icons.css" />
<link rel="stylesheet" href="<?=base_url(); ?>assets/css/animate.min.css" />

<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/chosen.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/colors/colors.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<script src="<?=base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/rating_css.css" />
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/font-awesome-pro.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/responsive.css" />
<?php if(empty($this->uri->segment(1))) { ?>
<meta property="og:title" content="><?php echo @$title?>" />
<meta property="og:url" content="<?php echo base_url();?>" />
<meta property="og:image" content="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" />
<meta property="og:description" content="<?php echo @$description?>" />
<meta property="og:site_name" content="<?php echo @$get_setting->website_name?>" />
<?php } ?>
<link rel="canonical" href="<?php echo current_url();?>">
<style>
.completeSub {display: none; text-align: center; margin-top: 20px; color: #fa5a1f; font-size: 20px;}
#completeSub {position: relative;display: inline-block;text-decoration: none;}
#completeSub #completeSubtext {visibility: hidden;width: max-content;background-color: white;color: #000;text-align: center;border-radius: 6px;padding: 5px 10px;position: absolute;z-index: 1;top: 50px;font-size: 13px;right: 0;}
#completeSub:hover #completeSubtext {visibility: visible;}

#frame #sidepanel #profile .wrap p {font-size: 14px !important;}
@media screen and (max-width: 425px) {
    .btn-extars {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
    .btn-extars .account-btns li:nth-child(2) {
        margin-left: 20px !important;
    }
}
</style>
<script>
function completeSub() {
    $('.completeSub').show();
    setTimeout(function(){
        $('.completeSub').fadeOut('slow');
    },4000);
}
$(function () {
    $('#completeSub').mouseover(function(){
        $("#completeSub").css("background-color", "yellow");
    });
})
</script>
</head>
<body>
    <div class="page-loading">
        <img src="<?=base_url(); ?>assets/images/loader.gif" alt="" />
    </div>
    <div class="theme-layout" id="scrollup">
        <div class="responsive-header" style="background: #ffffff;">
            <div class="responsive-menubar" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="res-logo">
                    <?php if(!empty($_SESSION['afrebay']['userId'])) { ?>
                    <a href="<?=base_url(); ?>homepage" title=""><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->flogo?>" alt="" /></a>
                    <?php } else { ?>
                    <a href="<?=base_url(); ?>" title=""><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->flogo?>" alt="" /></a>
                    <?php } ?>
                </div>
                <div class="menu-resaction">
                    <div class="res-openmenu" style="color: #000;"><i class="fa-sharp fa-light fa-bars"></i></div>
                    <div class="res-closemenu" style="color: #000;"><i class="fa-sharp fa-regular fa-xmark"></i></div>
                </div>
            </div>
            <div class="responsive-opensec" style="background: #00458c; padding: 0;">
                <div class="btn-extars" style="display: flex; align-items: center; justify-content: space-between; border-color: #fff; padding: 20px 30px;">
                <?php
                if(!empty($_SESSION['afrebay']['userId'])) {
                    if($_SESSION['afrebay']['userType'] == '2') {
                        if($get_setting->required_subscription == '1') {
                            $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['afrebay']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                            if(empty($get_sub_data)) { ?>
                            <a href="javascript:void(0)" title="" class="post-job-btn" style="text-decoration: none !important;" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                            <?php } else if(!empty($get_sub_data)) {
                                $profile_check = $this->db->query("SELECT `profilePic`, `firstname`, `lastname`, `email`, `address`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                                if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address'])  || empty($profile_check[0]['short_bio'])) { ?>
                                    <a href="javascript:void(0)" title="" class="post-job-btn" style="text-decoration: none !important;" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please complete your profile to proceed with the post job activities.</span></a>
                                <?php } else { ?>
                                    <a href="<?= base_url('postwork')?>" title="" class="post-job-btn" style="text-decoration: none !important;"><i class="la la-plus"></i>Post Work</a>
                                <?php } } else { ?>
                                <a href="<?= base_url('login')?>" title="" class="post-job-btn" style="text-decoration: none !important;"><i class="la la-plus"></i>Post Work</a>
                            <?php
                            } } else {
                            $profile_check = $this->db->query("SELECT `profilePic`, `firstname`, `lastname`, `email`, `address`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                            if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address'])  || empty($profile_check[0]['short_bio'])) { ?>
                                <a href="javascript:void(0)" title="" class="post-job-btn" style="text-decoration: none !important;" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please complete your profile to proceed with the post job activities.</span></a>
                            <?php
                            } else { ?>
                                <a href="<?= base_url('postwork')?>" title="" class="post-job-btn" style="text-decoration: none !important;"><i class="la la-plus"></i>Post Work</a>
                            <?php } } }
                } else { ?>
                <!-- <a href="<?= base_url('login')?>" title="" class="post-job-btn" style="text-decoration: none !important;"><i class="la la-plus"></i>Post Work</a> -->
                <?php } ?>
                    <ul class="account-btns" style="margin: 0;">
                        <?php if(!empty($_SESSION['afrebay']['userId'])){?>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>dashboard"><i class="la la-key"></i> My Account</a>
                            </li>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>logout"><i class="la la-external-link-square"></i> Logout</a>
                            </li>
                        <?php } else {?>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>signup" title=""><i class="la la-key"></i> Sign Up</a>
                            </li>
                            <li class="signin-popup">
                                <a href="<?= base_url('login')?>" title=""><i class="la la-external-link-square"></i> Login</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="responsivemenu" style="padding-left: 30px; padding-right: 30px;">
                    <!-- <ul>
                        <li class="account-btns">
                            <a href="<?= base_url('findwork')?>" title="">Find Work</a>
                        </li>
                        <li class="account-btns">
                            <a href="<?= base_url('customer')?>" title="">Customer</a>
                        </li>
                        <li class="account-btns">
                            <a href="<?= base_url('professionals')?>" title="">Professionals</a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
        <header class="stick-top forsticky bg-white">
            <div class="menu-sec">
                <div class="container-fluid Header_Menu_Nav">
                    <div class="d-flex align-items-center">
                        <div class="logo mr-5">
                        <?php if(!empty($_SESSION['afrebay']['userId'])) { ?>
                        <a href="<?=base_url(); ?>homepage" title="">
                            <img class="hidesticky" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" />
                            <img class="showsticky" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" />
                            <input type="hidden" class="hidden-logo" value="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>">
                        </a>
                        <?php } else { ?>
                        <a href="<?=base_url(); ?>" title="">
                            <img class="hidesticky" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" />
                            <img class="showsticky" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" />
                            <input type="hidden" class="hidden-logo" value="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>">
                        </a>
                        <?php } ?>
                        </div>
                        <div class="d-flex align-items-center">
                            <?php if(!empty($_SESSION['afrebay']['userId'])) { ?>
                            <form method="post" action="<?= base_url('search-work') ?>">
                                <div style="align-items: center !important; flex-direction: column;">
                                    <div class="d-flex position-relative">
                                        <div class="flex-fill w-100">
                                            <div class="job-field frmSearch">
                                                <input type="text" name="category_id" id="search-box" placeholder="Search " value="" />
                                            </div>
                                            <div id="suggesstion-box"></div>
                                        </div>
                                        <div class="topsrchBtn">
                                            <button type="submit"><i class="la la-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>
                            <nav>
                                <ul>
                                    <?php
                                    $uri = "$_SERVER[REQUEST_URI]";
                                    $uri = explode('/', $uri);
                                    $uri = $uri[2];
                                    ?>
                                    <?php
                                    if(!empty($_SESSION['afrebay']['userId'])) { ?>
                                    <li class="">
                                        <a href="<?= base_url('homepage')?>" title="" class="<?php if($uri == 'homepage') { echo "active"; } else {echo "";}?>"><i class="fa-solid fa-envelope-open"></i><?php if($uri == 'homepage') { echo " Home"; } else {echo "";}?></a>
                                    </li>
                                    <!-- <li class="">
                                        <a href="<?= base_url('findwork')?>" title="" class="<?php if($uri == 'findwork') { echo "active"; } else {echo "";}?>"><i class="fa-solid fa-briefcase"></i><?php if($uri == 'findwork') { echo " Find Work"; } else {echo "";}?></a>
                                    </li>
                                    <li class="">
                                        <a href="<?= base_url('professionals')?>" title="" class="<?php if($uri == 'professionals') { echo "active"; } else {echo "";}?>"><i class="fa-solid fa-user-group"></i><?php if($uri == 'professionals') { echo " Professionals"; } else {echo "";}?></a>
                                    </li> -->
                                    <?php } ?>
                                    <li class="">
                                    <?php
                                    if(!empty($_SESSION['afrebay']['userId'])) {
                                        if(is_numeric($_SESSION['afrebay']['userId'])) { ?>
                                        <a href="<?= base_url('postwork')?>" title=""><i class="fa-solid fa-comment-dots"></i></a>
                                    <?php } else { ?>
                                        <a href="javasctipt:void(0)" title="" onclick="forguestAlert()"><i class="fa-solid fa-comment-dots"></i></a>
                                    <?php } } ?>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-extars">
                        <ul class="account-btns">
                            <?php if(!empty($_SESSION['afrebay']['userId'])) {
                                if(!empty($_SESSION['afrebay']['firstname'])) {
                                    $fullname = $_SESSION['afrebay']['firstname']." ".$_SESSION['afrebay']['lastname'];
                                } else {
                                    $fullname = $_SESSION['afrebay']['companyname'];
                                }
                                ?>
                                <li class="menu-item-has-children User_Dashboard_Menu">
                                    <a class="Profile_dashboard_btn" href="javascript:void(0)" title="">
                                        <img src="https://techg.igiapp.com/handymanservices/uploads/users/2875_dafc3addfd37737b93fa9ecce064f73d.jpg" class="headprofileimg">
                                        <?= ucwords($fullname);?>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="<?=base_url(); ?>profile" title="">Update Profile</a>
                                        </li>
                                        <li>
                                            <?php
                                            $uid = $_SESSION['afrebay']['userType'];
                                            if(@$_SESSION['afrebay']['userType']=='1') { ?>
                                            <a href="<?php echo base_url("professionals_detail/".base64_encode($_SESSION['afrebay']['userId']))?>" title="">View Profile</a>
                                            <?php } else if(@$_SESSION['afrebay']['userType']=='2') { ?>
                                            <a href="<?php echo base_url("customer_detail/".base64_encode($_SESSION['afrebay']['userId']))?>" title="">View Profile</a>
                                            <?php } ?>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('password-reset')?>" title="">Change Password</a>
                                        </li>
                                        <li><a href="<?=base_url(); ?>logout">Logout</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="">
                                    <a href="<?=base_url(); ?>signup"><i class="la la-key"></i> Sign Up</a>
                                </li>
                                <li class="">
                                    <a href="<?=base_url(); ?>login"><i class="la la-external-link-square"></i> Sign In</a>
                                </li>
                            <?php } ?>
                            <!-- <li><a href="#" class="text-primary">
                                <span class="switchuser"></span> Switch</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </header>