<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)) {
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img; ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
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
                <h2 class="breadcrumb-title">Profile Settings</h2>
            </div>
        </div>
    </div>
</section>

<?php
if($data_request=='user') {
    $this->load->view('sidebar');
    $container='';
} else {
    $container='container';
}
?>
<div class="col-md-12 col-sm-12 display-table-cell v-align profileTabcontent">
    <div class="user-dashboard Admin_Profile form-design <?php echo $container;  ?> ">
        <form class="form" action="<?php echo base_url('user/Dashboard/update_profile')?>" method="post" id="registrationForm" enctype="multipart/form-data">
        <input type="hidden" name="from_data_request" value="<?=$data_request;?>">
            <div class="row row-sm">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="cardak profile-mobile p-0">
                        <span class="text-success-msg f-20" style="text-align: center;">
                        <?php if($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                            unset($_SESSION['message']);
                        } ?>
                        </span>
                        <div class="row">
                            <div class="bootstrap snippet col-xl-6 col-lg-6 col-md-6">
                                <div class="new-pro">
                                    <?php
                                    if(!empty($userinfo->profilePic)) {
                                        if(!file_exists('uploads/users/'.$userinfo->profilePic)) {
                                    ?>
                                    <img class="img-circle img-responsive" src="<?php echo base_url('uploads/no_image.png')?>" style="width:60px; height: 60px; object-fit: cover;" />
                                    <?php } else { ?>
                                    <img class="img-circle img-responsive" src="<?php echo base_url('uploads/users/'.$userinfo->profilePic); ?>" style="width:60px; height: 60px; object-fit: cover;" />
                                    <?php } } else { ?>
                                    <img class="img-circle img-responsive" src="<?php echo base_url('uploads/no_image.png')?>" style="width:60px; height: 60px; object-fit: cover;" />
                                    <?php } ?>
                                    <input type="hidden" name="old_image" value="<?=$userinfo->profilePic ?>">
                                    <input type="hidden" name="id" value="<?=$userinfo->userId  ?>">
                                    <div class="profile-ak">
                                        <?php if(!empty($userinfo->profilePic)) { ?>
                                        <h6>Upload a different photo</h6>
                                        <?php } else { ?>
                                            <h6>Upload a photo</h6>
                                        <?php } ?>
                                        <input type="file" name="profilePic" class="text-center center-block file-upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="bootstrap snippet col-xl-6 col-lg-6 col-md-6">
                                <div class="new-pro">
                                    <?php
                                    if(!empty($userinfo->backgroundPic)) {
                                        if(!file_exists('uploads/users/background/'.$userinfo->backgroundPic)) {
                                    ?>
                                    <img class="img-circle img-responsive" src="<?php echo base_url('uploads/no_image.png')?>" style="width:60px; height: 60px; object-fit: cover;" />
                                    <?php } else { ?>
                                    <img class="img-circle img-responsive" src="<?php echo base_url('uploads/users/background/'.$userinfo->backgroundPic); ?>" style="width:60px; height: 60px; object-fit: cover;" />
                                    <?php } } else { ?>
                                    <img class="img-circle img-responsive" src="<?php echo base_url('uploads/no_image.png')?>" style="width:60px; height: 60px; object-fit: cover;" />
                                    <?php } ?>
                                    <input type="hidden" name="old_bimage" value="<?=$userinfo->backgroundPic ?>">
                                    <input type="hidden" name="id" value="<?=$userinfo->userId  ?>">
                                    <div class="profile-ak">
                                        <?php if(!empty($userinfo->backgroundPic)) { ?>
                                        <h6>Upload a different background photo</h6>
                                        <?php } else { ?>
                                            <h6>Upload a background photo</h6>
                                        <?php } ?>
                                        <input type="file" name="backgroundPic" class="text-center center-block file-upload" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-dsd">
                            <div class="tab-content">
                                <div class="tab-pane active" style="padding: 0px;">
                                    <hr />
                                    <div class="form-group">
                                        <div class="row">
                                            <?php if(@$userinfo->userType == '2') { ?>
                                            <div class="col-lg-6 firstname">
                                                <label for="firstname">
                                                    <h4>First Name <span style="color:red;">*</span></h4>
                                                </label>
                                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value="<?php echo $userinfo->firstname;?>"  onkeypress="only_alphabets(event)" />
                                                <div id="vld_firstname" style="color:red; margin-top: 10px;">Please enter First Name.</div>
                                            </div>
                                            <div class="col-lg-6 lastname">
                                                <label for="lastname">
                                                    <h4>Last Name <span style="color:red;">*</span></h4>
                                                </label>
                                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo $userinfo->lastname;?>"  onkeypress="only_alphabets(event)" />
                                                <div id="vld_lastname" style="color:red; margin-top: 10px;">Please enter Last Name.</div>
                                            </div>
                                            <?php } else { ?>
                                            <div class="col-lg-12 companyname">
                                                <label for="companyname">
                                                    <h4>Business name</h4>
                                                </label>
                                                <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Business name" value="<?php echo $userinfo->companyname;?>" />
                                                <div id="vld_companyname" style="color:red; margin-top: 10px;">Please enter Business name.</div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-lg-6 email">
                                                <label for="email">
                                                    <h4>Email Address <span style="color:red;">*</span></h4>
                                                </label>
                                                <input type="text" class="form-control" name="email" id="email" placeholder="xyz@example.com" value="<?php echo $userinfo->email;?>" />
                                            </div>
                                            <div class="col-lg-6 mobile">
                                                <label for="mobile">
                                                    <h4>Phone Number </h4>
                                                </label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Phone Number" value="<?php echo $userinfo->mobile;?>" onkeypress="only_number(event)" maxlength="10" />
                                            </div>
                                            <?php  if(@$userinfo->userType == '1') { ?>
                                            <div class="col-lg-6 category">
                                                <label for="category">
                                                    <h4>Business Category<span style="color:red;">*</span></h4>
                                                </label>
                                                <select class="form-control business_category" multiple="multiple" name="business_category[]" id="business_category" style="width: 100%;">
                                                <?php
                                                    $business_category = $this->Crud_model->GetData('category',"","status = 'Active'");
                                                    foreach($business_category as $category) {?>
                                                        <option value="<?php echo $category->category_name; ?>"
                                                        <?php if(!empty($userinfo->serviceType)){
                                                            $serviceType = explode(", ", $userinfo->serviceType);
                                                            for($i=0; $i<count($serviceType); $i++) {
                                                                if($serviceType[$i] == $category->category_name){
                                                                    echo "selected";
                                                                }
                                                            }
                                                        } ?>><?php echo $category->category_name;?></option>
                                                    <?php } ?>
                                                </select>
                                                <div id="vld_gender" style="color:red; margin-top: 10px;">Please Select Business Category.</div>
                                            </div>
                                            <div class="col-lg-6 work_sample">
                                                <label for="work_sample">
                                                    <h4>Upload work samples<span style="font-weight: 500; font-size: 13px !important;">(Please upload images or videos only)</span></h4>
                                                </label>
                                                <input type="file" class="form-control" name="work_sample[]" id="work_sample" multiple/>
                                                <div>
                                                <?php
                                                $getworksampple = $this->db->query("SELECT * FROM users_work_sample WHERE user_id = '".$userinfo->userId."'")->result_array();
                                                if(!empty($getworksampple)) {
                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv'];
                                                foreach($getworksampple as $worksample) {
                                                $extension = pathinfo($worksample['work_sample'], PATHINFO_EXTENSION);
                                                if (in_array(strtolower($extension), $imageExtensions)) { ?>
                                                <img src="<?= base_url('uploads/users/work_sample/'.$worksample['work_sample']) ?>" alt="<?= $worksample['work_sample']?>" style="width: 100px;">
                                                <?php } elseif (in_array(strtolower($extension), $videoExtensions)) { ?>
                                                <video width="100" height="67" controls>
                                                    <source src="<?= base_url('uploads/users/work_sample/'.$worksample['work_sample'])?>" type="video/<?= $extension?>">
                                                    Your browser does not support the video tag or the file format of this video.
                                                </video>
                                                <?php } } }?>
                                                </div>
                                            </div>
                                            <?php  } ?>
                                            <div class="col-lg-6 location">
                                                <label for="location">
                                                    <h4>Legal Address <span style="color:red;">*</span></h4>
                                                </label>
                                                <input type="text" class="form-control" name="address" id="location" placeholder="Legal Address" value="<?= $userinfo->address ?>" style="height: 49px !important;" autocomplete="off" />
                                                <div id="vld_location" style="color:red; margin-top: 10px;">Please enter Legal Address.</div>
                                                <input type="hidden" name="latitude" id="search_lat" value="<?= $userinfo->latitude ?>">
                                                <input type="hidden" name="longitude" id="search_lon" value="<?= $userinfo->longitude ?> ">
                                            </div>
                                            <div class="col-lg-6 zip">
                                                <label for="zip">
                                                    <h4>Zip Code</h4>
                                                </label>
                                                <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip Code" value="<?php echo @$userinfo->zip;?>" onkeypress="only_number(event)" maxlength="6" />
                                            </div>
                                            <?php  if(@$userinfo->userType == '2') { ?>
                                            <div class="col-lg-6 gender">
                                                <label for="gender">
                                                    <h4>Gender<span style="color:red;">*</span></h4>
                                                </label>
                                                <select name="gender" id="gender" class="form-control"  style="height: 32px;">
                                                    <option value="">Gender</option>
                                                    <option value="Male" <?php if(@$userinfo->gender=='Male'){ echo "selected";}?>>Male</option>
                                                    <option value="Female" <?php if(@$userinfo->gender=='Female'){ echo "selected";}?>>Female</option>
                                                </select>
                                                <div id="vld_gender" style="color:red; margin-top: 10px;">Please Select Gender.</div>
                                            </div>
                                            <?php } ?>
                                            <?php if(@$userinfo->userType == '1') { ?>
                                            <div class="col-lg-6 key-skill">
                                                <span class="pf-title1">Specializations</span>
                                                <div class="pf-field">
                                                    <select class="form-control key_skills" multiple="multiple" name="key_skills[]" id="key_skills" style="width: 100%;">
                                                    <?php
                                                    $key_skills = $this->Crud_model->GetData('specialist',"","status = 'Active'");
                                                    foreach($key_skills as $val) {?>
                                                        <option value="<?php echo $val->specialist_name; ?>"
                                                        <?php if(!empty($userinfo->skills)){
                                                            $skills = explode(", ", $userinfo->skills);
                                                            for($i=0; $i<count($skills); $i++) {
                                                                if($skills[$i] == $val->specialist_name){
                                                                    echo "selected";
                                                                }
                                                            }
                                                        } ?>><?php echo $val->specialist_name;?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 work_hours">
                                                <label for="work_hours">
                                                    <h4>Rate per hour</h4>
                                                </label>
                                                <input type="text" class="form-control" name="hourly_rate" id="hourly_rate" placeholder="Rate per hour" value="<?php echo $userinfo->hourly_rate;?>" />
                                                <div id="vld_companyname" style="color:red; margin-top: 10px;">Please enter Rate per hour.</div>
                                            </div>
                                            <div class="col-lg-6 reference_link">
                                                <label for="reference_link">
                                                    <h4>Reference links</h4>
                                                </label>
                                                <input type="text" class="form-control" name="reference_link" id="reference_link" placeholder="Reference links" value="<?php echo $userinfo->reference_link;?>" />
                                            </div>
                                            <div class="col-lg-6 taxid">
                                                <label for="taxid">
                                                    <h4>TAX ID</h4>
                                                </label>
                                                <input type="text" class="form-control" name="taxid" id="taxid" placeholder="TAX ID" value="<?php echo $userinfo->taxid;?>" />
                                                <div id="vld_teamsize" style="color:red; margin-top: 10px;">Please enter TAX ID.</div>
                                            </div>
                                            <div class="col-lg-6 foundedyear">
                                                <label for="foundedyear">
                                                    <h4>Founded Year</h4>
                                                </label>
                                                <input type="text" class="form-control" name="foundedyear" id="foundedyear" placeholder="Founded Year" value="<?php echo $userinfo->foundedyear;?>" />
                                                <div id="vld_teamsize" style="color:red; margin-top: 10px;">Please enter Founded Year.</div>
                                            </div>
                                            <div class="col-lg-6 Team Size">
                                                <label for="Team Size">
                                                    <h4>Team Size</h4>
                                                </label>
                                                <input type="text" class="form-control" name="teamsize" id="teamsize" placeholder="Team Size" value="<?php echo $userinfo->teamsize;?>" />
                                                <div id="vld_teamsize" style="color:red; margin-top: 10px;">Please enter Team Size.</div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-lg-12 short_bio">
                                                <label for="short_bio">
                                                    <h4>Short Bio <span style="color:red;">*</span></h4>
                                                </label>
                                                <textarea class="form-control" name="short_bio" id="short_bio" placeholder="Short Bio" maxlength="1000"><?= @$userinfo->short_bio ?></textarea>
                                                <div id="the-count">
                                                    <span id="current">0</span>
                                                    <span id="maximum">/ 1000</span>
                                                </div>
                                                <div id="vld_shrtBio" style="color:red; margin-top: 10px;">Please enter short bio.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12 aksek">
                                            <button class="post-job-btn pull-right" type="submit">Save Changes</button>
                                            <input type="hidden" name="utype" id="utype" value="<?= @$userinfo->userType?>">
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
<style>
.Admin_Profile .cardak .gender select {margin-bottom: 0px !important;}
.form-design form .cardak .profile-dsd input  {margin-bottom: 0px !important;}
.col-lg-6 {margin-bottom: 20px !important;}
#vld_shrtBio {display: none;}
#vld_firstname {display: none;}
#vld_lastname {display: none;}
#vld_gender {display: none;}
#vld_location {display: none;}
#vld_companyname {display: none;}
#vld_teamsize {display: none;}
.container:before,
.container:after { display: none !important; }
@media (min-width: 1250px) {
    .container.Header_Menu_Nav {
        width: 1250px !important;
    }
}
@media screen and (max-width: 425px) {
    .new-pro {
        flex-direction: column !important;
    }
    .new-pro .profile-ak {
        margin-left: 0 !important;
    }
}
.select2-selection--multiple {border: none !important;}
.select2-container .select2-search--inline {width: 100% !important;}
.select2-search__field {width: 100% !important;}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script type="text/javascript">
$('#skills').tagsinput({
    confirmKeys: [13, 44],
    maxTags: 20,
});
$('.business_category').select2({
    //tags: true,
    tokenSeparators: [','],
    placeholder: "Select or Type Business Category",
});

$('.key_skills').select2({
    //tags: true,
    tokenSeparators: [','],
    placeholder: "Select or Type Specialization",
});

$('#short_bio').keyup(function() {
    var characterCount = $(this).val().length,
    current = $('#current'),
    maximum = $('#maximum'),
    theCount = $('#the-count');
    current.text(characterCount);
    if (characterCount < 500) {
        current.css('color', '#666');
    }
    if (characterCount > 500 && characterCount < 650) {
        current.css('color', '#6d5555');
    }
    if (characterCount > 650 && characterCount < 750) {
        current.css('color', '#793535');
    }
    if (characterCount > 750 && characterCount < 850) {
        current.css('color', '#841c1c');
    }
    if (characterCount > 850 && characterCount < 999) {
        current.css('color', '#8f0001');
    }

    if (characterCount >= 740) {
        maximum.css('color', '#8f0001');
        current.css('color', '#8f0001');
        theCount.css('font-weight','bold');
    } else {
        maximum.css('color','#666');
        theCount.css('font-weight','normal');
    }
});
$("form").submit( function(e) {
    if($('#utype').val() == 1) {
        if($('#firstname').val() == ''){
            $('#firstname').focus().attr('placeholder', 'This field is required');
            $('#vld_firstname').show();
            $('#firstname').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_firstname").hide();},5000)
            e.preventDefault();
        }
        if($('#lastname').val() == ''){
            $('#lastname').focus().attr('placeholder', 'This field is required');
            $('#vld_lastname').show();
            $('#lastname').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_lastname").hide();},5000)
            e.preventDefault();
        }
        if($('#gender').val() == ''){
            $('#gender').focus().attr('placeholder', 'This field is required');
            $('#vld_gender').show();
            $('#gender').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_gender").hide();},5000)
            e.preventDefault();
        }
        if($('#location').val() == ''){
            $('#location').focus().attr('placeholder', 'This field is required');
            $('#vld_location').show();
            $('#location').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_location").hide();},5000)
            e.preventDefault();
        }
        if($('#short_bio').val() == ''){
            $('#short_bio').focus().attr('placeholder', 'This field is required');
            $('#vld_shrtBio').show();
            $('#short_bio').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_shrtBio").hide();},5000)
            e.preventDefault();
        }
    } else {
        /*if($('#companyname').val() == ''){
            $('#companyname').focus().attr('placeholder', 'This field is required');
            $('#vld_companyname').show();
            $('#companyname').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_companyname").hide();},5000)
            e.preventDefault();
        }*/
        if($('#location').val() == ''){
            $('#location').focus().attr('placeholder', 'This field is required');
            $('#vld_location').show();
            $('#location').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_location").hide();},5000)
            e.preventDefault();
        }
        /*if($('#teamsize').val() == ''){
            $('#teamsize').focus().attr('placeholder', 'This field is required');
            $('#vld_teamsize').show();
            $('#teamsize').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_teamsize").hide();},5000)
            e.preventDefault();
        }*/
        if($('#short_bio').val() == ''){
            $('#short_bio').focus().attr('placeholder', 'This field is required');
            $('#vld_shrtBio').show();
            $('#short_bio').focus().css('border', '1px solid red');
            setTimeout(function(){$("#vld_shrtBio").hide();},5000)
            e.preventDefault();
        }
    }
});
</script>
