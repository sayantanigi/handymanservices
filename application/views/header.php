<?php
$get_setting = $this->Crud_model->get_single('setting');
$get_category = $this->Crud_model->GetData('category', '', "status='Active'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> <?php if (!empty(@$title)) { echo $title . " - " . @$get_setting->website_name; } else { echo @$get_setting->website_name; } ?> </title>
<?php if ($this->uri->segment(1) == 'customer_detail') { ?>
<meta name="description" content="<?php echo @$userdata->short_bio ?>">
<?php } else if ($this->uri->segment(1) == 'professionals_detail') { ?>
<meta name="description" content="<?php echo @$user_detail->short_bio ?>">
<?php } else if ($this->uri->segment(1) == 'workdetail') { ?>
<meta name="description" content="<?php echo @$post_data->description ?>">
<?php } else if ($this->uri->segment(1) == 'about-us') { ?>
<meta name="description" content="">
<?php } else if ($this->uri->segment(1) == 'productdetail') { ?>
<meta name="description" content="<?php echo $prod_details[0]['prod_description']; ?>">
<?php } else if ($this->uri->segment(1) == 'findwork') { ?>
<meta name="description" content="">
<?php } else if ($this->uri->segment(1) == 'career-tips') {
$description = explode('.', $get_career->description) ?>
<meta name="description" content="<?= $description[0] ?>">
<?php } else { ?>
<meta name="description" content="<?php echo @$description ?>">
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="<?= base_url(); ?>uploads/logo/<?= $get_setting->favicon ?>" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap-grid.css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/icons.css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/chosen.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/colors/colors.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/rating_css.css" />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/font-awesome-pro.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/responsive.css" />
<script src="<?= base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
<?php if (empty($this->uri->segment(1))) { ?>
<meta property="og:title" content="><?php echo @$title ?>" />
<meta property="og:url" content="<?php echo base_url(); ?>" />
<meta property="og:image" content="<?= base_url(); ?>uploads/logo/<?= $get_setting->logo ?>" />
<meta property="og:description" content="<?php echo @$description ?>" />
<meta property="og:site_name" content="<?php echo @$get_setting->website_name ?>" />
<?php } ?>
<link rel="canonical" href="<?php echo current_url(); ?>">
<style>
.completeSub{display:none;text-align:center;margin-top:20px;color:#fa5a1f;font-size:20px}
#completeSub{position:relative;display:inline-block;text-decoration:none}
#completeSub #completeSubtext{visibility:hidden;width:max-content;background-color:#fff;color:#000;text-align:center;border-radius:6px;padding:5px 10px;position:absolute;z-index:1;top:50px;font-size:13px;right:0}
#completeSub:hover #completeSubtext{visibility:visible}
#frame #sidepanel #profile .wrap p{font-size:14px!important}@media screen and (max-width:425px){.btn-extars{flex-direction:column!important;align-items:flex-start!important}}
.categories_style {font-size: 14px; padding: 0; font-weight: 500; color: #000; letter-spacing: .2px; margin-right: 15px; height: 30px; border-radius: 100px; padding-left: 10px; padding-right: 10px; border: 1px solid #efefef; }
.Header_Menu_Nav .active hr {margin-bottom: -20px !important; height: 2px !important; background: #2892ff !important;}
/* .Header_Menu_Nav hr {margin: 0 !important;} */
</style>
<script>
function completeSub() {
    $('.completeSub').show();
    setTimeout(function () {
        $('.completeSub').fadeOut('slow');
    }, 4000);
}
$(function () {
    $('#completeSub').mouseover(function () {
        $("#completeSub").css("background-color", "yellow");
    });
})
</script>
</head>

<body>
    <div class="page-loading">
        <img src="<?= base_url(); ?>assets/images/loader.gif" alt="" />
    </div>
    <div class="theme-layout" id="scrollup">
        <div class="responsive-header" style="background: #ffffff;">
            <div class="responsive-menubar" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="res-logo">
                    <?php if (!empty(@$_SESSION['afrebay']['userId'])) { ?>
                    <a href="<?= base_url(); ?>homepage" title=""><img src="<?= base_url(); ?>uploads/logo/<?= $get_setting->flogo ?>" alt="" /></a>
                    <?php } else { ?>
                    <a href="<?= base_url(); ?>" title=""><img src="<?= base_url(); ?>uploads/logo/<?= $get_setting->flogo ?>" alt="" /></a>
                    <?php } ?>
                </div>
                <div class="menu-resaction">
                    <div class="res-openmenu" style="color: #000;"><i class="fa-sharp fa-light fa-bars"></i></div>
                    <div class="res-closemenu" style="color: #000;"><i class="fa-sharp fa-regular fa-xmark"></i></div>
                </div>
            </div>
            <div class="responsive-opensec" style="background: #00458c; padding: 0;">
                <div class="btn-extars" style="display: flex; align-items: center; justify-content: space-between; border-color: #fff; ">
                    <ul class="account-btns" style="margin: 0;">
                        <?php if (!empty(@$_SESSION['afrebay']['userId'])) { ?>
                        <li class="signup-popup w-100 ml-0">
                            <a href="<?= base_url(); ?>profile"><i class="la la-user"></i> My Account</a>
                        </li>
                        <li class="signup-popup w-100 ml-0">
                            <?php
                            $uid = $_SESSION['afrebay']['userType'];
                            if (@$_SESSION['afrebay']['userType'] == '1') { ?>
                            <a href="<?php echo base_url("professionals_detail/" . base64_encode(@$_SESSION['afrebay']['userId'])) ?>" title=""><i class="la la-eye"></i> View Profile</a>
                            <?php } else if (@$_SESSION['afrebay']['userType'] == '2') { ?>
                            <a href="<?php echo base_url("customer_detail/" . base64_encode(@$_SESSION['afrebay']['userId'])) ?>" title=""><i class="la la-eye"></i> View Profile</a>
                            <?php } ?>
                        </li>
                        <li class="signup-popup w-100 ml-0">
                            <a href="<?= base_url(); ?>profile"><i class="la la-key"></i> Change Password</a>
                        </li>
                        <li class="signup-popup w-100 ml-0">
                            <a href="<?= base_url(); ?>logout"><i class="la la-external-link-square"></i> Logout</a>
                        </li>
                        <?php } else { ?>
                        <li class="signup-popup">
                            <a href="<?= base_url(); ?>signup" title=""><i class="la la-key"></i> Sign Up</a>
                        </li>
                        <li class="signin-popup">
                            <a href="<?= base_url('login') ?>" title=""><i class="la la-external-link-square"></i> Login</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="responsivemenu" style="padding-left: 30px; padding-right: 30px;"></div>
            </div>
        </div>
        <header class="stick-top forsticky bg-white" style="padding: 4px 0;">
            <div class="menu-sec">
                <div class="container-fluid Header_Menu_Nav">
                    <div class="d-flex align-items-center">
                        <div class="logo mr-2">
                            <?php if (!empty(@$_SESSION['afrebay']['userId'])) { ?>
                            <a href="<?= base_url(); ?>homepage" title="">
                                <img class="hidesticky" src="<?= base_url(); ?>uploads/logo/<?= $get_setting->logo ?>" alt="" />
                                <img class="showsticky" src="<?= base_url(); ?>uploads/logo/<?= $get_setting->logo ?>" alt="" />
                                <input type="hidden" class="hidden-logo" value="<?= base_url(); ?>uploads/logo/<?= $get_setting->logo ?>">
                            </a>
                            <?php } else { ?>
                            <a href="<?= base_url(); ?>" title="">
                                <img class="hidesticky" src="<?= base_url(); ?>uploads/logo/<?= $get_setting->logo ?>" alt="" />
                                <img class="showsticky" src="<?= base_url(); ?>uploads/logo/<?= $get_setting->logo ?>" alt="" />
                                <input type="hidden" class="hidden-logo" value="<?= base_url(); ?>uploads/logo/<?= $get_setting->logo ?>">
                            </a>
                            <?php } ?>
                        </div>
                        <nav>
                            <ul>
                                <?php
                                $uri = "$_SERVER[REQUEST_URI]";
                                $uri = explode('/', $uri);
                                $uri = $uri[2];
                                ?>
                                <?php
                                if (!empty(@$_SESSION['afrebay']['userId'])) { ?>
                                <li class="">
                                    <a href="<?= base_url('homepage') ?>" title="Home" class="<?php if ($uri == 'homepage') { echo "active"; } else { echo ""; } ?>" style="background: none; ">
                                        <i class="fa-solid fa-house"></i></i><?php if ($uri == 'homepage') { echo ""; } else { echo ""; } ?>
                                        <?php if ($uri == 'homepage') { echo "<hr>"; } else { echo ""; } ?>
                                    </a>
                                </li>
                                <?php } ?>
                                <li class="">
                                <?php
                                if (!empty(@$_SESSION['afrebay']['userId'])) {
                                    if (is_numeric(@$_SESSION['afrebay']['userId'])) { ?>
                                    <a href="<?= base_url('chat') ?>" title="Messages" class="<?php if ($uri == 'chat') { echo "active"; } else { echo ""; } ?>" style="background: none;">
                                        <i class="fa-solid fa-comment-dots"></i><?php if ($uri == 'chat') { echo ""; } else { echo ""; } ?>
                                        <?php if ($uri == 'chat') { echo "<hr>"; } else { echo ""; } ?>
                                    </a>
                                    <?php } else { ?>
                                    <a href="javasctipt:void(0)" title="" onclick="forguestAlert()"><i class="fa-solid fa-comment-dots"></i></a>
                                <?php } } ?>
                                </li>
                            </ul>
                        </nav>
                        <div class="d-flex align-items-center" style="margin-left: 70px !important;">
                            <?php if (!empty(@$_SESSION['afrebay']['userId'])) { ?>
                            <form method="post" action="<?= base_url('search-work') ?>">
                                <div style="align-items: center !important; flex-direction: column; margin-right: 20px;">
                                    <div class="d-flex position-relative">
                                        <div class="flex-fill w-100">
                                            <div class="job-field frmSearch">
                                                <input type="text" name="search_title" id="search-box" placeholder="Search " value="" />
                                            </div>
                                            <div id="suggesstion-box"></div>
                                        </div>
                                        <div class="topsrchBtn">
                                            <button type="submit"><i class="la la-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <select name="category" id="category" class="categories_style" style="border-radius: 10px; padding-top: 10px; padding-bottom: 10px; height: 40px;" onchange="getcategorydata(this.value);">
                                <option value="0">All Category</option>
                                <?php
                                $getCategory = $this->db->query("SELECT * FROM category WHERE status = 'Active'")->result_array();
                                if(!empty($getCategory)) {
                                foreach($getCategory as $item) { ?>
                                <option value="<?= $item['id'] ?>"><?= ucfirst($item['category_name'])?></option>
                                <?php } }?>
                            </select>
                            <select name="distance" id="distance" class="categories_style" style=" border-radius: 10px; padding-top: 10px; padding-bottom: 10px; height: 40px;" onchange="getdistancedata(this.value);">
                                <option value="1">Global</option>
                                <option value="2">Local</option>
                            </select>
                            <a style="font-size: 13px; padding: 8px 15px; background: #2892ff; color: #fff; border-radius: 10px; padding-top: 10px; padding-bottom: 10px;" href="javascript:void(0)" class="filterbtn" data-toggle="modal" data-target="#filterModal">Filter <i class="fa-regular fa-sliders ml-1"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="btn-extars">
                        <?php if (is_numeric(@$_SESSION['afrebay']['userId'])) { ?>
                        <ul class="account-btns">
                        <?php if (!empty(@$_SESSION['afrebay']['userId'])) { ?>
                            <li class="menu-item-has-children User_Dashboard_Menu">
                                <a class="Profile_dashboard_btn" href="javascript:void(0)" title="">
                                    <?php
                                    $getUserimg = $this->db->query("SELECT * FROM users WHERE userId = '" . @$_SESSION['afrebay']['userId'] . "'")->row();
                                    if (!empty($getUserimg->profilePic) && file_exists('uploads/users/' . $getUserimg->profilePic)) {
                                        $img = base_url('uploads/users/' . $getUserimg->profilePic);
                                    } else {
                                        $img = base_url('uploads/no_pimage.png');
                                    }
                                    ?>
                                    <img src="<?= $img; ?>" class="headprofileimg">
                                    <?= ucwords("@".$_SESSION['afrebay']['username']); ?>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?= base_url(); ?>profile" title="">Update Profile</a>
                                    </li>
                                    <li>
                                        <?php
                                        $uid = $_SESSION['afrebay']['userType'];
                                        if (@$_SESSION['afrebay']['userType'] == '1') { ?>
                                            <a href="<?php echo base_url("professionals_detail/" . base64_encode(@$_SESSION['afrebay']['userId'])) ?>"
                                                title="">View Profile</a>
                                        <?php } else if (@$_SESSION['afrebay']['userType'] == '2') { ?>
                                                <a href="<?php echo base_url("customer_detail/" . base64_encode(@$_SESSION['afrebay']['userId'])) ?>"
                                                    title="">View Profile</a>
                                        <?php } ?>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('password-reset') ?>" title="">Change Password</a>
                                    </li>
                                    <li><a href="<?= base_url(); ?>logout">Logout</a></li>
                                </ul>
                            </li>
                            <?php } else { ?>
                            <li class="">
                                <a href="<?= base_url(); ?>signup"><i class="la la-key"></i> Sign Up</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url(); ?>login"><i class="la la-external-link-square"></i> Sign In</a>
                            </li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>