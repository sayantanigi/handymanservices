<section class="dashboard-gig User_Sidemenu">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9 display-table-cell v-align profileTabcontent my-4">
			     <div class="user-dashboard Admin_Profile form-design <?php echo $container;  ?> ">
			        <h3 class="text-center h3 font-weight-bold text-dark my-3">Create your profile</h3>
			        <p class="text-center text-dark">You may modify your profile information at any moment in your profile section</p>
			        <form class="form" action="<?php echo base_url('user/Dashboard/update_businessDetails')?>" method="post" id="registrationForm" enctype="multipart/form-data">
			        <input type="hidden" name="from_data_request" value="<?=$data_request;?>">
			            <div class="row row-sm">
			                <div class="col-xl-12 col-lg-12 col-md-12">
			                    <div class="px-4 py-3">
			                        <div class="profiletab position-relative d-flex">
			                            <div class="tabBox d-flex w-auto">
                                            <a href="<?= base_url()?>profile" class="tabnav">My Profile</a>
                                            <?php if($_SESSION['afrebay']['userType'] == '1') { ?>
                                            <a href="<?= base_url()?>business_details" class="tabnav active">Business Details</a>
                                            <?php } ?>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="cardak profile-mobile pt-3">
			                    	<div class="row">
			                    		<div class="col-lg-6 profile-dsd">
                                            <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Business name" value="<?php echo $userinfo->companyname;?>" />
                                            <div id="vld_companyname" style="color:red; margin-top: 10px;">Please enter Business name.</div>
			                            </div>
			                            <div class="col-lg-6 profile-dsd">
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
			                            <div class="col-lg-6 profile-dsd">
                                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Phone Number" value="<?php echo $userinfo->mobile;?>" onkeypress="only_number(event)" maxlength="10" />
			                            </div>
			                            <div class="col-lg-6 profile-dsd">
                                            <input type="text" class="form-control" name="address" id="location" placeholder="Legal Address" value="<?= $userinfo->address ?>" style="height: 49px !important;" autocomplete="off" />
                                            <div id="vld_location" style="color:red; margin-top: 10px;">Please enter Legal Address.</div>
                                            <input type="hidden" name="latitude" id="search_lat" value="<?= $userinfo->latitude ?>">
                                            <input type="hidden" name="longitude" id="search_lon" value="<?= $userinfo->longitude ?> ">
			                            </div>
			                            <div class="col-lg-6 profile-dsd">
                                            <input type="text" class="form-control" name="hourly_rate" id="hourly_rate" placeholder="Rate per hour" value="<?php echo $userinfo->hourly_rate;?>" />
                                            <div id="vld_companyname" style="color:red; margin-top: 10px;">Please enter Rate per hour.</div>
			                            </div>
			                            <div class="col-lg-6 profile-dsd">
                                            <input type="text" class="form-control" name="reference_link" id="reference_link" placeholder="Reference links" value="<?php echo $userinfo->reference_link;?>" />
			                            </div>
                                        <div class="col-lg-12 mb-4">
                                            <div class="new-pro uploadProfilephoto workupload">
                                                <?php
                                                $getWorkSample = $this->db->query("SELECT * FROM users_work_sample WHERE user_id = '".$userinfo->userId."'")->result_array();
                                                if(!empty($getWorkSample)) { ?>
                                                <div class="profileImgBox">
                                                <?php foreach ($getWorkSample as $sample) {
                                                    $extension = strtolower(pathinfo($sample['work_sample'], PATHINFO_EXTENSION));
                                                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) { ?>
                                                    <img src="<?= base_url('uploads/users/work_sample/'.$sample['work_sample']); ?>" alt="Image" style="width: 165px;height: 110px;">
                                                    <?php } elseif (in_array($extension, ['mp4', 'webm', 'avi', 'mov'])) { ?>
                                                    <video width="165" height="110" controls>
                                                    <source src="<?= base_url('uploads/users/work_sample/'.$sample['work_sample']); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                    </video>
                                                    <?php } else { ?>
                                                    <p>Unsupported file type</p>
                                                    <?php } } ?>
                                                </div>
                                                <?php } else { ?>
                                                <div class="profileImgBox profilenoImg  py-4">
                                                    <img src="<?php echo base_url('uploads/addPhoto.png')?>"/>
                                                    <h6>Upload work samples</h6>
                                                    <p>Images must be less than 5 MB in size</p>
                                                    <p>Videos must be less than 25 MB in size</p>
                                                </div>
                                                <?php } ?>
                                                <div class="profile-ak">
                                                    <label>
                                                        <h6><i class="fa-solid fa-cloud-arrow-up"></i> Upload </h6>
                                                        <input type="file" name="work_sample[]" multiple class="d-none" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
			                        </div>
			                        <div class="text-center px-3">
			                        	<button class="post-job-btn float-right mw-150" type="submit">Finish</button>
                                        <input type="hidden" name="id" value="<?=$userinfo->userId  ?>">
			                        	<a href="<?= base_url()?>homepage" class="post-job-btn float-right mr-3 mw-150 btn-secondary">Leave and complete later</a>
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
#vld_gender {display: none;}
#vld_location {display: none;}
#vld_companyname {display: none;}
.select2-selection--multiple {border: none !important;}
.select2-container .select2-search--inline {width: 100% !important;}
.select2-selection__rendered li{margin-bottom: 5px !important;}
.select2-search__field {width: 100% !important; margin-top: 0px !important; min-height: 50px !important; font-size: 14px !important;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
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
</script>