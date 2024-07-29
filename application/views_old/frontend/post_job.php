<?php
error_reporting(0);
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>

<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Post Work</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block no-padding">
        <div class="container">
            <div class="row no-gape">
                <div class="col-lg-12 column">
                    <div class="padding-left">
                        <div class="profile-title" style="text-align: center;">
                            <?php if(empty(@$id)) { ?>
                            <h3>Post a New Job</h3>
                            <?php } else { ?>
                            <h3>Update Posted Work</h3>
                            <?php } ?>
                            <span class="text-success-msg f-20" style="text-align: center;">
                            <?php if($this->session->flashdata('message')) {
                                echo $this->session->flashdata('message');
                                unset($_SESSION['message']);
                            } ?>
                            </span>
                        </div>
                        <div class="profile-form-edit post-job-page">
                            <?php $seg1=$this->uri->segment(1);
                            if($seg1 == 'update-postjob') { ?>
                            <form method="post" action="<?php echo base_url('Welcome/edit_post_job')?>" enctype="multipart/form-data" style="padding: 0 !important;" >
                            <?php } else { ?>
                                <form method="post" action="<?php echo base_url('Welcome/save_postjob')?>" enctype="multipart/form-data"  style="padding: 0 !important;">
                            <?php } ?>
                                <!-- <input type="hidden" name="timeZone" id="timeZone" value=""> -->
                                <div class="row">
                                    <div class="bootstrap snippet col-xl-6 col-lg-6 col-md-6">
                                        <div class="new-pro">
                                            <?php
                                            if(!empty($userinfo->profilePic)) {
                                                if(!file_exists('uploads/postjob/'.$userinfo->profilePic)) {
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
                                                <h6>Upload different photos</h6>
                                                <?php } else { ?>
                                                    <h6>Upload photos</h6>
                                                <?php } ?>
                                                <input type="file" name="postjobPic[]" multiple class="text-center center-block file-upload" />
                                            </div>
                                            <div style=" width: 100%; display: contents;">
                                            <?php
                                            $getJobImage = $this->db->query("SELECT * FROM postjob_image WHERE job_id='".$id."'")->result_array();
                                            //print_r($getJobImage); die();
                                            if(!empty($getJobImage)){
                                            foreach ($getJobImage as $val) { ?>
                                                <img class="img-circle_<?php echo $val['id']?> img-responsive" src="<?php echo base_url('uploads/postjob/'.$val['job_image']); ?>" style="width:60px;height: 60px;"/>
                                                <img class="img-circle-close_<?php echo $val['id']?> img-responsive" src="<?php echo base_url('uploads/close-icon.png'); ?>" onclick="deleteJobImg(<?php echo $val['id']?>);" style="width: 15px; height: 15px; position: relative;top: -7px; right: 8px;"/>
                                            <?php } } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Job Title <span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <input type="text" placeholder="Enter Job Title" name="post_title" id="post_title" class="form-control " value="<?= @$post_title; ?>" data-role="tagsinput" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Description</span>
                                        <div class="pf-field">
                                            <textarea name="description" id="description" placeholder="Enter Description"><?= @$description; ?></textarea>
                                        </div>
                                    </div>
                                    <div id="advanceFieldheading" class="col-lg-12">
                                        <div style="margin-top: 20px;">
                                            <p style="padding: 20px;background: #fb6b20;color: #fff;font-size: 18px;font-weight: 500;border-radius: 10px;cursor: pointer;">Show Advanced Options: </p>
                                        </div>
                                    </div>
                                    <div id="advanceFieldcontent" class="col-lg-12">
                                        <div class="contact-edit" style="display: contents;">
                                            <div class="col-lg-6">
                                                <span class="pf-title">Find On Map </span>
                                                <div class="pf-field">
                                                    <input type="text" placeholder="Collins Street West, Victoria 8007, Australia." name="location" value="<?= @$location; ?>" id="location" autocomplete="off"/>
                                                </div>
                                                <div class="pf-field">
                                                    <input type="text" id="search_lat" name="latitude"  placeholder="41.1589654" value="<?= @$latitude; ?>"/>
                                                </div>
                                                <div class="pf-field">
                                                    <input type="text" id="search_lon" placeholder="21.1589654" name="longitude" value="<?= @$longitude; ?>"/>
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="button" class="srch-lctn" onclick="return show_location();">Search Location</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <span class="pf-title">Maps</span>
                                                <div class="pf-map" id="map"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="pf-title">Required Skill Set</span>
                                            <div class="pf-field custom-select">
                                                <select class="form-control key_skills" multiple="multiple" name="key_skills[]" id="key_skills" style="width: 100%;">
                                                <!-- <?php foreach($getkey_skills as $val) {?>
                                                    <option value="<?php echo $val->specialist_name; ?>"><?php echo $val->specialist_name;?></option>
                                                <?php } ?> -->
                                                <?php
                                                $skills = $this->Crud_model->GetData('specialist',"","status = 'Active'");
                                                foreach($skills as $val) {?>
                                                    <option value="<?php echo $val->specialist_name; ?>"
                                                    <?php if(!empty($key_skills)) {
                                                        if(!empty($skills)){
                                                            $vskills = explode(", ", $key_skills);
                                                            for($i=0; $i<count($vskills); $i++) {
                                                                if($vskills[$i] == $val->specialist_name){
                                                                    echo "selected";
                                                                }
                                                            }
                                                        }
                                                    } ?>><?php echo $val->specialist_name;?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="pf-title">Job Type</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select Option" class="form-control" name="duration">
                                                    <option value="">Select Option</option>
                                                    <option value="Full-Time" <?php if($duration == "Full-Time") {echo "selected";}?>>Full-Time</option>
                                                    <option value="Part-Time" <?php if($duration == "Part-Time") {echo "selected";}?>>Part-Time</option>
                                                    <option value="Internship" <?php if($duration == "Internship") {echo "selected";}?>>Internship</option>
                                                    <option value="Recurring Project" <?php if($duration == "Recurring Project") {echo "selected";}?>>Recurring Project</option>
                                                    <option value="Contract" <?php if($duration == "Contract") {echo "selected";}?>>Contract</option>
                                                    <option value="Temporary" <?php if($duration == "Temporary") {echo "selected";}?>>Temporary</option>
                                                    <option value="Freelance" <?php if($duration == "Freelance") {echo "selected";}?>>Freelance</option>
                                                    <option value="Seasonal" <?php if($duration == "Seasonal") {echo "selected";}?>>Seasonal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="pf-title">Pay Type</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select Option" class="form-control" name="pay_type">
                                                    <option value="">Select Option</option>
                                                    <option value="Hourly Rate" <?php if($pay_type == "Hourly Rate") {echo "selected";}?>>Hourly Rate</option>
                                                    <option value="Salary" <?php if($pay_type == "Salary") {echo "selected";}?>>Salary</option>
                                                    <option value="Project-Based Fee" <?php if($pay_type == "Project-Based Fee") {echo "selected";}?>>Project-Based Fee</option>
                                                    <option value="Stipend" <?php if($pay_type == "Stipend") {echo "selected";}?>>Stipend</option>
                                                    <option value="Commission" <?php if($pay_type == "Commission") {echo "selected";}?>>Commission</option>
                                                    <option value="Piece Rate" <?php if($pay_type == "Piece Rate") {echo "selected";}?>>Piece Rate</option>
                                                    <option value="Per Diem" <?php if($pay_type == "Per Diem") {echo "selected";}?>>Per Diem</option>
                                                    <option value="Seasonal" <?php if($pay_type == "Seasonal") {echo "selected";}?>>Seasonal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="pf-title">Estimated Pay</span>
                                            <div style="width: 75px; float: left;">
                                                <?php if($countryName == 'Nigeria') {
                                                $sym = '₦'; ?>
                                                <input type="text" class="form-control f1" name="currency" id="currency" value="NGN (₦)" readonly style=" padding: 15px; ">
                                                <?php } else {
                                                $sym = '$'; ?>
                                                <input type="text" class="form-control f1" name="currency" id="currency" value="USD ($)" readonly style=" padding: 15px; ">
                                                <?php } ?>
                                            </div>
                                            <div class="pf-field" style="width: 79%;">
                                                <select data-placeholder="Please Select Category" class="form-control" name="charges" style=" float: left; width: 100%; margin-left: 10px;">
                                                    <option value="">Select Option</option>
                                                    <option value="Less than <?= $sym?>100" <?php if($charges == "Less than'.$sym.'100") {echo "selected";}?>>Less than <?= $sym?>100</option>
                                                    <option value="<?= $sym?>100 - <?= $sym?>500" <?php if($charges == $sym.'100 - '.$sym.'500') {echo "selected";}?>><?= $sym?>100 - <?= $sym?>500</option>
                                                    <option value="<?= $sym?>500 - <?= $sym?>1K" <?php if($charges == $sym.'500 - '.$sym.'1K') {echo "selected";}?>><?= $sym?>500 - <?= $sym?>1K</option>
                                                    <option value="<?= $sym?>1K - <?= $sym?>5K" <?php if($charges == $sym.'1K - '.$sym.'5K') {echo "selected";}?>><?= $sym?>1K - <?= $sym?>5K</option>
                                                    <option value="<?= $sym?>5K - <?= $sym?>10k" <?php if($charges == $sym.'5K - '.$sym.'10k') {echo "selected";}?>><?= $sym?>5K - <?= $sym?>10k</option>
                                                    <option value="<?= $sym?>10k - <?= $sym?>50k" <?php if($charges == $sym.'10k - '.$sym.'50k') {echo "selected";}?>><?= $sym?>10k - <?= $sym?>50k</option>
                                                    <option value="<?= $sym?>50k - <?= $sym?>85k" <?php if($charges == $sym.'50k - '.$sym.'85k') {echo "selected";}?>><?= $sym?>50k - <?= $sym?>85k</option>
                                                    <option value="<?= $sym?>100,000+" <?php if($charges == $sym.'100,000+') {echo "selected";}?>><?= $sym?>100,000+</option>
                                                    <option value="<?= $sym?>200,000+" <?php if($charges == $sym.'200,000+') {echo "selected";}?>><?= $sym?>200,000+</option>
                                                    <option value="<?= $sym?>400,000+" <?php if($charges == $sym.'400,000+') {echo "selected";}?>><?= $sym?>400,000+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Categories</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select Category" class="form-control" name="category_id" onchange="get_subcategory(this.value)">
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    $getcategory = $this->Crud_model->GetData('category', 'id, category_name', "");
                                                    foreach($getcategory as $key) {?>
                                                        <option value="<?= $key->id; ?>" <?php if($key->id == $category) {echo "selected"; }?>><?php echo $key->category_name;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Subcategories</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select " class="form-control" name="subcategory_id" value="" id="subcategory_id">
                                                    <?php if(empty($id)) { ?>
                                                    <option>Select Subcategory</option>
                                                    <?php } else { ?>
                                                    <option>Select Subcategory</option>
                                                        <?php
                                                        $getsubcategory = $this->Crud_model->GetData('sub_category', 'id, sub_category_name', "");
                                                        foreach($getsubcategory as $key) {?>
                                                            <option value="<?= $key->id; ?>" <?php if($key->id == $subcategory) {echo "selected"; }?>><?php echo $key->sub_category_name;?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="pf-title">Application Deadline Date</span>
                                            <div class="pf-field">
                                                <input type="date" placeholder="Enter Complete Address" name="appli_deadeline" class="form-control datepicker" value="<?= @$appli_deadeline; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-lg-4">
                                        <span class="pf-title">Country <span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select class="form-control" name="country-dropdown" id="country-dropdown" style="width: 100%;">
                                                <option value="">Select Country</option>
                                            <?php
                                            $get_country = $this->Crud_model->GetData('countries', 'id, name', "");
                                            foreach($get_country as $val) {?>
                                                <option value="<?php echo $val->name; ?>" <?php if($val->name == @$countries) {echo "selected"; }?>><?php echo $val->name;?></option>
                                            <?php } ?>
                                            </select>
                                            <input type="hidden" id="select_country_dropdown" value="<?php echo @$countries; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="pf-title">State <span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select class="form-control" name="state-dropdown" id="state-dropdown">
                                            <?php if(empty($id)) { ?>
                                                <option value="">Select State</option>
                                                <?php } else { ?>
                                                <option>Select State</option>
                                            <?php } ?>
                                            </select>
                                            <input type="hidden" id="select_state_dropdown" value="<?php echo @$state; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="pf-title">City <span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select class="form-control" name="city-dropdown" id="city-dropdown">
                                                <?php if(empty($id)) { ?>
                                                    <option value="">Select City</option>
                                                    <?php } else { ?>
                                                    <option>Select City</option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" id="select_city_dropdown" value="<?php echo @$cities; ?>">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="contact-edit">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit">Submit</button>
                                            <input type="hidden" name="id" value="<?php echo @$id?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
CKEDITOR.replace('description');
</script>
<style>
.key_skills {margin-bottom: 0px !important;}
#advanceFieldcontent{display: none;}
.active{display: contents !important; transition: all .7s;}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap"></script>
<script>
$('.key_skills').select2({
    //tags: true,
    tokenSeparators: [','],
    placeholder: "Select or Type Skills"
});
function show_location() {
    var location=$('#location').val();
    $('#map').html('<iframe src="https://maps.google.it/maps?q='+location+'&output=embed"></iframe>');
    $('#complete_address').val(location);
}
$(document).ready(function() {
    var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $("#timeZone").val(userTimezone);
    $("#advanceFieldheading").click(function(){
        $("#advanceFieldcontent").toggleClass('active');
    })
    $('#country-dropdown').on('change', function() {
        var country_name = this.value;
        $.ajax({
            url: "<?php echo base_url()?>Welcome/states_by_country",
            type: "POST",
            data: {
                country_name: country_name
            },
            cache: false,
            success: function(result){
                $("#state-dropdown").html(result);
                $('#city-dropdown').html('<option value="">Select State First</option>');
            }
        });
    });
    $('#state-dropdown').on('change', function() {
        var state_name = this.value;
        $.ajax({
            url: "<?php echo base_url()?>Welcome/cities_by_state",
            type: "POST",
            data: {
                state_name: state_name
            },
            cache: false,
            success: function(result){
                $("#city-dropdown").html(result);
            }
        });
    });
    if($('#select_country_dropdown').val() != '') {
        var country_name = $('#select_country_dropdown').val();
        $.ajax({
            url: "<?php echo base_url()?>Welcome/states_by_country",
            type: "POST",
            data: {
                country_name: country_name
            },
            cache: false,
            success: function(result){
                //console.log(result);
                $("#state-dropdown").html(result);
                $("#state-dropdown").val(state_name);
            }
        });
    }
    if($('#select_state_dropdown').val() != '') {
        var state_name = $('#select_state_dropdown').val();
        $.ajax({
            url: "<?php echo base_url()?>Welcome/cities_by_state",
            type: "POST",
            data: {
                state_name: state_name
            },
            cache: false,
            success: function(result){
                $("#city-dropdown").html(result);
                $("#city-dropdown").val($('#select_city_dropdown').val());
            }
        });
    }


    // var location=$('#location').val(); alert(location)
    // $('#map').html('<iframe src="https://maps.google.it/maps?q='+location+'&output=embed"></iframe>');
    // $('#complete_address').val(location);

    var location = {
        latitude: '',
        longitude: ''
    };
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        // latitudeAndLongitude.innerHTML="Geolocation is not supported by this browser.";
    }
    function showPosition(position) {
        location.latitude = position.coords.latitude;
        location.longitude = position.coords.longitude;
        "<br>Longitude: " + position.coords.longitude;
        var geocoder = new google.maps.Geocoder();
        var latLng = new google.maps.LatLng(location.latitude, location.longitude);
        $('#search_lat').val(location.latitude);
        $('#search_lon').val(location.longitude);
        if (geocoder) {
            geocoder.geocode({ 'latLng': latLng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results);
                    $('#location').val(results[0].formatted_address);
                    $('#map').html('<iframe src="https://maps.google.it/maps?q='+results[0].formatted_address+'&output=embed"></iframe>');
                    $('#complete_address').val(results[0].formatted_address);
                }
                else {
                    $('#location').html('Geocoding failed: ' + status);
                    console.log("Geocoding failed: " + status);
                }
            });
        }
    }
});

function deleteJobImg(pi_id) {
    var id = pi_id;
    var base_url = $('#base_url').val();
    $('.img-circle_'+id).css('display','none');
    $('.img-circle-close_'+id).css('display','none');
    $.ajax({
        url:base_url+"user/Dashboard/delete_job_image",
        method:"POST",
        data:{id: id},
        beforeSend : function(){},
        success:function(data) {}
    })
}
</script>
<!-- <script>
// Get the user's timezone
var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

// Send the timezone to the server using a hidden form
document.addEventListener('DOMContentLoaded', (event) => {
    var timezoneForm = document.createElement('form');
    timezoneForm.method = 'POST';
    var timezoneInput = document.createElement('input');
    timezoneInput.type = 'hidden';
    timezoneInput.name = 'timezone';
    timezoneInput.value = userTimezone;
    timezoneForm.appendChild(timezoneInput);
    document.body.appendChild(timezoneForm);

    timezoneForm.submit();
});
</script> -->