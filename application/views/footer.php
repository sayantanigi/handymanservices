<?php
$get_setting=$this->Crud_model->get_single('setting');
if(!empty($_SESSION['afrebay']['userId'])) {
    $userid=$_SESSION['afrebay']['userId'];
    $get_video=$this->Crud_model->GetData('friends_video','',"subscription_id='".$userid."' and status='0'",'','(video_id)desc','','1');
}
?>
<?php
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link1 = explode('/', $actual_link);
$url = end($actual_link1);
?>
<footer class="<?php if($url == "" || $url == "signup" || $url == "login"  || $url == "homepage") { echo "d-none"; }?>">
    <div class="blocknwe">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="widget">
                        <div class="about_widget">
                            <div class="logo">
                                <a href="<?=base_url(); ?>" title=""><img
                                        src="<?=base_url(); ?>uploads/logo/<?= $get_setting->flogo?>" alt="" /></a>
                            </div>
                            <?php if(!empty($get_setting->fabout)) { ?>
                            <span><?= $get_setting->fabout?></span>
                            <?php } else { ?>
                            <span></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="widget">
                        <h3 class="footer-title Primary_Text_Color">Quick Links</h3>
                        <div class="link_widgets">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="<?= base_url('about-us')?>" title="About us">About Us</a>
                                    <a href="<?= base_url('contact-us')?>" title="Contact us">Contact Us</a>
                                    <!-- <a href="<?= base_url('customer')?>" title="Explore Customers">Explore Customers</a>
                                    <a href="<?= base_url('professionals')?>" title="Explore Professionals">Explore Professionals</a> -->
                                    <a href="<?= base_url('findwork')?>" title="Explore Job Openings">Explore Job Openings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="widget">
                        <h3 class="footer-title Primary_Text_Color">Support Link</h3>
                        <div class="link_widgets">
                            <div class="row">
                                <div class="col-lg-12">

                                    <a href="<?= base_url('career-tips')?>" title="Blog">Blog</a>
                                    <a href="<?= base_url('privacy-policy')?>" title="Privacy Policy">Privacy Policy</a>
                                    <a href="<?= base_url('term-and-conditions')?>" title="Term & Condition">Terms & Conditions </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="about_widget">
                        <h3 class="footer-title Primary_Text_Color">Contact Us</h3>
                        <div class="link_widgets">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="#" class="address_cstm"><?= $get_setting->address?></a>
                                    <a href="#"><?= $get_setting->phone ?></a>
                                    <a href="#"><?= $get_setting->email ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="social">
                        <a href="<?php echo $get_setting->fb_link; ?>" title="" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="<?php echo $get_setting->tw_link; ?>" title="" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="<?php echo $get_setting->lnkd_link; ?>" title="" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-line">
        <span>Copyright © <?php echo date('Y')?> Handyman Services. All rights reserved.</span>
        <a href="#scrollup" class="scrollup" title=""><i class="la la-arrow-up"></i></a>
    </div>
</footer>
<input type="hidden" name="base_url" id="base_url" value="<?= base_url()?>">
<style>
<?php $seg2 = $this->uri->segment(1);
    if($seg2 == 'signup') { ?>
        .scrollup {display: none !important;}
    <?php } elseif ($seg2 != 'login') { ?>
        .scrollup {display: none !important;}
    <?php } ?>
.address_cstm {margin: 0px !important;}
.address_cstm p {color: #fff; font-family: Open Sans; font-size: 13px; line-height: normal; margin-bottom: 12px;}
</style>
<?php
if(!empty($_SESSION['afrebay']['userId'])){
    if(!empty($get_video->created_date)){
        $date=date('Y-m-d',strtotime(@$get_video->created_date));
    }
    if(@$_SESSION['afrebay']['userId']==@$get_video->subscription_id && $date==date('Y-m-d') && @$get_video->status=='0'){
?>
<div id="video_modal" class="modal modal-top fade calendar-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Receive video calling </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    onclick="receiveVideoCallWindow(<?= @$get_video->publisher_id?>);">video call</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php }
} ?>
<!--  end modal -->
<script src="<?= base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/modernizr.js')?>" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/script.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/wow.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/slick.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/parallax.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/select-chosen.js')?>" type="text/javascript"></script>
<!-- <script src="<?= base_url('assets/js/maps2.js')?>" type="text/javascript"></script> -->
<script src="<?= base_url('assets/js/bootstrap-datepicker.js')?>" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback"></script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/validation.js')?>"></script>
<script src="<?= base_url();?>dist/assets/notify/notify.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-dark-feather.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-dark.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-light-feather.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-light.min.css" />
<script src="<?php echo base_url()?>assets/multi_select/js/tail.select.min.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-de.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-es.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-fi.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-fr.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-it.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-no.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-pt_BR.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-ru.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-tr.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<link href="https://rawgit.com/mervick/emojionearea/master/dist/emojionearea.css" rel="stylesheet" />
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
<script src="https://rawgit.com/mervick/emojionearea/master/dist/emojionearea.js"></script>
<script type="text/javascript">
var confirmTextDelete = 'Are you sure you want to delete this record?';
var confirmationText = 'Are you sure you want to change this status?';
$(document).ready(function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);
    } else {
        $('#location').html('Geolocation is not supported by this browser.');
    }
    tail.select('#example',{
        startOpen: true,
        multiple: true,
        stayOpen: true,
        multiPinSelected: true,
        multiShowCount: false,
        multiShowLimit: true,
        multiContainer: true,
        search: true,
        searcgConfig: [
            "text", "value"
        ],
        searchFocus: true,
        searchMarked: true,
        searchMinLength: 1,
    });
    var sessionMessage = '<?php echo $this->session->userdata('
    message ') <> '
    ' ? $this->session->userdata('
    message ') : '
    '; ?>';
    if (sessionMessage == null || sessionMessage == "") {
        return false;
    }
    $.notify(sessionMessage, {
        position: "top right",
        className: 'success'
    }); //session msg
    $('.dropdown-optgroup').click(function() {
        var selected = $(".dropdown-optgroup :selected").map((_,e) => e.value).get();
        alert(selected);
    });

    var location = {latitude: '', longitude: ''};
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        //latitudeAndLongitude.innerHTML="Geolocation is not supported by this browser.";
        //
    }
});
function showLocation(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    displayLocation(latitude, longitude);
}

function displayLocation(latitude, longitude) {
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);
    geocoder.geocode({'latLng': latlng},
       function (results, status) {
           if (status == google.maps.GeocoderStatus.OK) {
               if (results[0]) {
                   var add = results[0].formatted_address;
                   $('#location').val(results[0].formatted_address);
                   $('#location_guest').val(results[0].formatted_address);
                   $('#search_lat').val(latitude);
                   $('#search_lat_guest').val(latitude);
                   $('#search_lon').val(longitude);
                   $('#search_lon_guest').val(longitude);
                   var value = add.split(",");
                   count = value.length;
                   country = value[count - 1];
                   state = value[count - 2];
                   city = value[count - 3];
                   $("#paymentLocation").val(city);
               }
           }
       }
    );
}
setInterval(function () {
    $('#video_modal').modal('show');
}, 5000);
var targetDiv = $('.about_widget img').attr('src');
var targetDiv1 = $('.hidden-logo').val();
/*$(window).scroll(function () {
    var windowpos = $(window).scrollTop();
    if (windowpos >= 50) {
        $(".Header_Menu_Nav img").attr("src", targetDiv);
        $(".Header_Menu_Nav img").attr("src", targetDiv);
    } else {
        $(".Header_Menu_Nav img").attr("src", targetDiv1);
        $(".Header_Menu_Nav img").attr("src", targetDiv1);
    }
});*/
function receiveVideoCallWindow(fid) {
    $('#video_modal').css('display', 'none');
    var callPath = "<?php echo base_url('livevideo/video/');?>" + fid;
    window.open(callPath, "_blank",
        "toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=20,width=600,height=450");
}
function loginAlert() {
    $.alert({
	    title: '',
	    content: "Already Logged In. Please logout for new registration",
	});
}
function forguestAlert() {
    // $.alert({
	//     title: '',
	//     content: "Kindly register or login to participate in this activity.",
	// });
    $.alert({
        title: '',
        content: 'Kindly register or login to participate in this activity.',
        animation: 'scale',
        closeAnimation: 'scale',
        buttons: {
            okay: { // Customize the OK button
                text: 'Sign In', // Text for the OK button
                btnClass: 'btn-blue', // Custom class for styling the OK button
                action: function () {
                    // Action to perform when OK button is clicked
                    // Example: redirecting to login or registration page
                    window.location.href = '<?= base_url()?>login';
                }
            },
            cancel: { // Customize the Cancel button
                text: 'Sign Up', // Text for the Cancel button
                btnClass: 'btn-blue', // Custom class for styling the Cancel button
                action: function () {
                    // Action to perform when Cancel button is clicked
                    // Example: do nothing or close the alert
                    window.location.href = '<?= base_url()?>';
                }
            },
            somethingElse: {
                text: 'Close',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                }
            }
        }
    });
}
</script>
</body>
</html>
