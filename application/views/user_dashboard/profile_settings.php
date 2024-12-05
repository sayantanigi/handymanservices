<?php
if (!empty($get_banner->image) && file_exists('uploads/banner/' . $get_banner->image)) {
    $banner_img = base_url("uploads/banner/" . $get_banner->image);
} else {
    $banner_img = base_url("assets/images/resource/mslider1.jpg");
} ?>

<?php
if ($data_request == 'user') {
    $this->load->view('sidebar');
    $container = '';
} else {
    $container = 'container';
    $style = 'style="margin-left: 170px;"';
}
?>
<div class="col-lg-9 display-table-cell v-align profileTabcontent my-4" <?php echo $style; ?>>
    <div class="user-dashboard Admin_Profile form-design <?php echo $container; ?> ">
        <h3 class="text-center h3 font-weight-bold Primary_Text_Color my-3">Update your profile</h3>
        <p class="text-center text-dark">You may modify your profile information at any moment in your profile section </p>
        <form class="form" action="<?php echo base_url('user/Dashboard/update_profile') ?>" method="post" id="registrationForm" enctype="multipart/form-data">
            <input type="hidden" name="from_data_request" value="<?= $data_request; ?>">
            <div class="row row-sm">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="px-4 py-3">
                        <div class="profiletab position-relative d-flex">
                            <div class="tabBox d-flex w-auto">
                                <?php if (!empty(@$_SESSION['afrebay']['user_id'])) { ?>
                                    <a href="<?= base_url() ?>profile" class="tabnav active">My Profile</a>
                                    <a href="<?= base_url() ?>business_details" class="tabnav">Business Details</a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>profile/<?= $this->uri->segment(2); ?>" class="tabnav active">My Profile</a>
                                    <a href="<?= base_url() ?>business_details/<?= $this->uri->segment(2); ?>" class="tabnav">Business Details</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="cardak profile-mobile p-0">
                        <span class="text-success-msg f-20" style="text-align: center;">
                            <?php if ($this->session->flashdata('message')) {
                                echo $this->session->flashdata('message');
                                unset($_SESSION['message']);
                            } ?>
                            <?php if ($this->session->flashdata('error')) {
                                echo $this->session->flashdata('error');
                                unset($_SESSION['error']);
                            } ?>
                        </span>
                        <div class="row">
                            <div class="bootstrap snippet col-xl-6 col-lg-6 col-md-6">
                                <div class="new-pro uploadProfilephoto">
                                    <div class="profileImgBox profilenoImg profileupload" style="<?php if (!empty($userinfo->profilePic) && file_exists('uploads/users/' . $userinfo->profilePic)) { echo 'padding: 0px !important'; } ?>">
                                        <?php if (!empty($userinfo->profilePic) && file_exists('uploads/users/' . $userinfo->profilePic)) { ?>
                                        <img id="output_image" src="<?php echo base_url('uploads/users/' . $userinfo->profilePic); ?>" class="activeImg"    />
                                        <?php } else { ?>
                                        <img id="output_image" src="<?php echo base_url('uploads/usernoimg.png') ?>" />
                                        <h6>Upload profile picture</h6>
                                        <p>must be less than 5 MB in size</p>
                                        <?php } ?>
                                    </div>
                                    <input type="hidden" name="old_image" value="<?= $userinfo->profilePic ?>">
                                    <input type="hidden" name="id" value="<?= $userinfo->userId ?>">
                                    <div class="profile-ak">
                                        <label>
                                            <?php if (!empty($userinfo->profilePic)) { ?>
                                                <h6><i class="fa-solid fa-cloud-arrow-up"></i> Upload </h6>
                                            <?php } else { ?>
                                                <h6><i class="fa-solid fa-cloud-arrow-up"></i> Upload</h6>
                                            <?php } ?>
                                            <input type="file" name="profilePic" class="text-center center-block file-upload d-none" onchange="preview_profileimage(event)"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 profile-dsd">
                                <div class="mb-4 float-left w-100">
                                    <input type="text" class="form-control" name="firstname" id="firstname"
                                        placeholder="First Name" value="<?php echo $userinfo->firstname; ?>"
                                        onkeypress="only_alphabets(event)" />
                                    <div id="vld_firstname" style="color:red; margin-top: 10px;">Please enter First
                                        Name.</div>
                                </div>
                                <div class="mb-4 float-left w-100">
                                    <input type="text" class="form-control" name="lastname" id="lastname"
                                        placeholder="Last Name" value="<?php echo $userinfo->lastname; ?>"
                                        onkeypress="only_alphabets(event)" />
                                    <div id="vld_lastname" style="color:red; margin-top: 10px;">Please enter Last Name.
                                    </div>
                                </div>
                                <?php
                                $pattern = '/\b\d{6}\b/';
                                // Use preg_match to find the postal code
                                if (preg_match($pattern, $userinfo->address, $matches)) {
                                    $postalCode = $matches[0];
                                }
                                ?>
                                <div class="mb-0 float-left w-100">
                                    <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip Code"
                                        value="<?php echo @$postalCode; ?>" onkeypress="only_number(event)"
                                        maxlength="6" />
                                    <div id="vld_zip" style="color:red; margin-top: 10px;">Please enter Zip Code.</div>
                                </div>
                            </div>
                            <?php //if($_SESSION['afrebay']['userType'] == '2') { ?>
                            <div class="col-lg-4 profile-dsd">
                                <div class="mb-4 float-left w-100">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo $userinfo->email; ?>" />
                                </div>
                            </div>
                            <div class="col-lg-4 profile-dsd">
                                <div class="mb-4 float-left w-100">
                                    <input type="text" class="form-control" name="mobile" id="mobile"
                                        placeholder="Contact Number" value="<?php echo $userinfo->mobile; ?>" />
                                </div>
                            </div>
                            <?php //} ?>
                            <div class="col-lg-4 profile-dsd">
                                <div class="mb-4 float-left w-100">
                                    <select class="form-control" name="rate_enabled" id="rate_enabled">
                                        <option value="">Choose an option</option>
                                        <option value="1" <?php if ($userinfo->rate_enabled == '1') {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        } ?>>Show rating on profile</option>
                                        <option value="2" <?php if ($userinfo->rate_enabled == '2') {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        } ?>>Don't show rating on profile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <div class="new-pro uploadProfilephoto bgupload">
                                    <?php $getWorkSample = $this->db->query("SELECT * FROM user_background WHERE user_id = '" . $userinfo->userId . "'")->result_array(); ?>
                                    <div class="profileImgBox profilenoImg py-4" id="preview" style="<?php if (!empty($getWorkSample)) {echo 'padding: 0px !important';}?>">
                                        <?php if (!empty($getWorkSample)) {
                                            foreach ($getWorkSample as $sample) {
                                            $extension = strtolower(pathinfo($sample['filecontent'], PATHINFO_EXTENSION));
                                            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'avif', 'webp'])) { ?>
                                        <img src="<?= base_url('uploads/users/background/' . $sample['filecontent']); ?>" alt="Image" style="width: 215px; height: 150px; object-fit: cover !important;">
                                        <i class="fa fa-trash" style="position: absolute; margin-top: 5px; margin-left: -35px; color: red; background: #eee; padding: 8px; border-radius: 20px;" onclick="deleteImage(<?= $sample['id']?>)"></i>
                                        <?php } elseif (in_array($extension, ['mp4', 'webm', 'avi', 'mov'])) { ?>
                                            <video width="215" height="150" controls>
                                                <source src="<?= base_url('uploads/users/background/' . $sample['filecontent']); ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <i class="fa fa-trash" style="position: absolute; margin-top: 5px; margin-left: -35px; color: red; background: #eee; padding: 8px; border-radius: 20px;" onclick="deleteImage(<?= $sample['id']?>)"></i>
                                        <?php } ?>
                                        <?php } } else { ?>
                                            <img src="<?php echo base_url('uploads/addPhoto.png')?>"/>
                                            <h6>Upload backgroud image</h6>
                                            <p>Images must be less than 5 MB in size</p>
                                            <p>Videos must be less than 25 MB in size</p>
                                        <?php } ?>
                                    </div>
                                    <div class="profile-ak">
                                        <label>
                                            <h6><i class="fa-solid fa-cloud-arrow-up"></i> Upload </h6>
                                            <input type="file" name="backgroundPic[]" multiple class="d-none" accept="image/*, video/*" id="file-input"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 profile-dsd">
                                <textarea class="form-control" name="short_bio" id="short_bio" placeholder="Short Bio"
                                    maxlength="1000" placeholder="About me"><?= @$userinfo->short_bio ?></textarea>
                                <div id="vld_shrtBio" style="color:red; margin-top: 10px;">Please enter short bio.</div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="" style="display: inline-block; float: inline-end;">
                                        <?php if ($_SESSION['afrebay']['userType'] == '1') { ?>
                                            <img src="<?= base_url("uploads/grey_loader.gif") ?>"
                                                id="save_profile_dataloader" style="width: 50px;">
                                            <button class="post-job-btn float-right mw-150 Gradient_Back_Color"
                                                style="border: none !important;" type="submit"
                                                id="save_profile_data">Save</button>
                                        <?php } else { ?>
                                            <img src="<?= base_url("uploads/grey_loader.gif") ?>"
                                                id="save_profile_dataloader" style="width: 50px;">
                                            <button class="post-job-btn float-right mw-150 Gradient_Back_Color"
                                                style="border: none !important;" type="submit"
                                                id="save_profile_data">Save</button>
                                        <?php } ?>
                                        <input type="hidden" name="utype" id="utype" value="<?= @$userinfo->userType ?>">
                                        <?php if (!empty(@$_SESSION['afrebay']['user_id'])) { ?>
                                            <input type="hidden" name="uid" id="uid"
                                                value="<?= @$_SESSION['afrebay']['user_id'] ?>">
                                        <?php } else { ?>
                                            <input type="hidden" name="uid" id="uid"
                                                value="<?= base64_decode($this->uri->segment(2)); ?>">
                                        <?php } ?>
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
.Admin_Profile .cardak .gender select,.form-design form .cardak .profile-dsd input{margin-bottom:0!important}.col-lg-6{margin-bottom:20px!important}#save_profile_dataloader,#vld_companyname,#vld_firstname,#vld_gender,#vld_lastname,#vld_location,#vld_shrtBio,#vld_teamsize,#vld_zip{display:none}.container:after,.container:before{display:none!important}@media (min-width:1250px){.container.Header_Menu_Nav{width:1250px!important}}@media screen and (max-width:425px){.new-pro{flex-direction:column!important}.new-pro .profile-ak{margin-left:0!important}}.select2-selection--multiple{border:none!important}.select2-container .select2-search--inline,.select2-search__field{width:100%!important}
.activeImg{width: 100% !important; height: 178px !important; object-fit: cover !important;}
/* #preview {width: 100%; height: auto; display: flex; flex-wrap: wrap; padding: 0 !important;} */
.preview-item {width: 215px; height: 150px; margin: 0px 5px 5px 0px; display: flex; justify-content: center; align-items: center;}
.preview-item img, .preview-item video {width: 215px !important; height: 150px !important; object-fit: cover !important;}
.jconfirm .jconfirm-box .jconfirm-buttons button.btn-blue {background: #9dcc90 !important; }
</style>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
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

function preview_profileimage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
    $('.profilenoImg').css('padding', '0px');
    $('.profileupload h6').hide();
    $('.profileupload p').hide();
    $('#output_image').addClass('activeImg');
}

var fileInput = document.getElementById('file-input');
var preview = document.getElementById('preview');

fileInput.addEventListener('change', function() {
    displayFiles(this.files);
    $('#preview').css({"height": "auto", "display": "flex", "flex-wrap": "wrap", "justify-content": "space-between"});
});

function displayFiles(files) {
    //preview.innerHTML = '';
    for (var i = 0; i < files.length; i++) {
    var file = files[i];
    var reader = new FileReader();

    reader.onload = (function(file) {
        return function(e) {
        var fileType = file.type.split('/')[0];
        var previewItem = document.createElement('div');
        previewItem.className = 'preview-item';
        var previewElement;

        if (fileType === 'image') {
            previewElement = document.createElement('img');
        } else if (fileType === 'video') {
            previewElement = document.createElement('video');
            previewElement.controls = true;
        } else {
            return; // Unsupported file type
        }
        previewElement.src = e.target.result;
        previewItem.appendChild(previewElement);
        preview.appendChild(previewItem);
        };
    })(file);

    reader.readAsDataURL(file);
    }
}

$('#short_bio').keyup(function () {
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
        theCount.css('font-weight', 'bold');
    } else {
        maximum.css('color', '#666');
        theCount.css('font-weight', 'normal');
    }
});

$("form").submit(function (e) {
    if ($('#utype').val() == 1) {
        if ($('#firstname').val() == '') {
            $('#firstname').focus().attr('placeholder', 'This field is required');
            $('#vld_firstname').show();
            $('#firstname').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_firstname").hide(); }, 5000)
            e.preventDefault();
        }
        if ($('#lastname').val() == '') {
            $('#lastname').focus().attr('placeholder', 'This field is required');
            $('#vld_lastname').show();
            $('#lastname').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_lastname").hide(); }, 5000)
            e.preventDefault();
        }
        if ($('#gender').val() == '') {
            $('#gender').focus().attr('placeholder', 'This field is required');
            $('#vld_gender').show();
            $('#gender').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_gender").hide(); }, 5000)
            e.preventDefault();
        }
        if ($('#location').val() == '') {
            $('#location').focus().attr('placeholder', 'This field is required');
            $('#vld_location').show();
            $('#location').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_location").hide(); }, 5000)
            e.preventDefault();
        }
        if ($('#short_bio').val() == '') {
            $('#short_bio').focus().attr('placeholder', 'This field is required');
            $('#vld_shrtBio').show();
            $('#short_bio').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_shrtBio").hide(); }, 5000)
            e.preventDefault();
        }
    } else {
        if ($('#firstname').val() == '') {
            $('#firstname').focus().attr('placeholder', 'This field is required');
            $('#vld_firstname').show();
            $('#firstname').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_firstname").hide(); }, 5000);
            $("#save_profile_dataloader").hide();
            $(".Gradient_Back_Color").prop('disabled', false);
            e.preventDefault();
        }
        if ($('#lastname').val() == '') {
            $('#lastname').focus().attr('placeholder', 'This field is required');
            $('#vld_lastname').show();
            $('#lastname').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_lastname").hide(); }, 5000);
            $("#save_profile_dataloader").hide();
            $(".Gradient_Back_Color").prop('disabled', false);
            e.preventDefault();
        }
        if ($('#rate_enabled').val() == '') {
            $('#rate_enabled').focus().attr('placeholder', 'This field is required');
            $('#vld_rate_enabled').show();
            $('#rate_enabled').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_rate_enabled").hide(); }, 5000);
            $("#save_profile_dataloader").hide();
            $(".Gradient_Back_Color").prop('disabled', false);
            e.preventDefault();
        }
        if ($('#zip').val() == '') {
            $('#zip').focus().attr('placeholder', 'This field is required');
            $('#vld_zip').show();
            $('#zip').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_zip").hide(); }, 5000);
            $("#save_profile_dataloader").hide();
            $(".Gradient_Back_Color").prop('disabled', false);
            e.preventDefault();
        }
        if ($('#short_bio').val() == '') {
            $('#short_bio').focus().attr('placeholder', 'This field is required');
            $('#vld_shrtBio').show();
            $('#short_bio').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_shrtBio").hide(); }, 5000);
            $("#save_profile_dataloader").hide();
            $(".Gradient_Back_Color").prop('disabled', false);
            e.preventDefault();
        }
    }
});

$("#save_profile_data").on('click', function () {
    $("#save_profile_dataloader").show();
    return true;
})

function deleteImage(id) {
    $.alert({
        title: '',
        content: 'Are you sure you want to delete this file? Once delete it can\'t be undone',
        animation: 'scale',
        closeAnimation: 'scale',
        buttons: {
            yes: {
                text: 'Yes',
                btnClass: 'btn-blue-cstm',
                keys: ['enter', 'shift'],
                action: function () {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('user/dashboard/deletecoverImage')?>",
                        data: { id: id },
                        success: function (data) {
                            res = JSON.parse(data);
                            if(res.status == 'success'){
                                $.alert({
                                    title: '',
                                    content: res.message,
                                    animation: 'scale',
                                    closeAnimation: 'scale',
                                    buttons: {
                                        ok: {
                                            text: 'Ok',
                                            btnClass: 'btn-blue-cstm',
                                            keys: ['enter', 'shift'],
                                            action: function(){
                                                window.location.reload();
                                            }
                                        }
                                    }
                                });
                            } else {
                                $.alert({
                                    title: '',
                                    content: res.message,
                                    animation: 'scale',
                                    closeAnimation: 'scale',
                                    buttons: {
                                        ok: {
                                            text: 'Ok',
                                            btnClass: 'btn-blue-cstm',
                                            keys: ['enter', 'shift'],
                                            action: function(){
                                                window.location.reload();
                                            }
                                        }
                                    }
                                });
                            }
                        }
                    })
                }
            },
            no: {
                text: 'No',
                btnClass: 'btn-blue-cstm',
                keys: ['enter', 'shift'],
                action: function(){
                }
            }
        }
    });
}
</script>