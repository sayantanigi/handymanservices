<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= base_url('assets/images/resource/mslider1.jpg') ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
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
                <h2 class="breadcrumb-title">Messages</h2>
            </div>
        </div>
    </div>
</section>

<section class="dashboard-gig Chat_User">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <?php $this->load->view('sidebar'); ?>
            <div class="container Custom_Chat_Design">
                <div class="col-md-8 col-lg-8 col-sm-12 display-table-cell v-align">
                    <div class="user-dashboard">
                        <div class="row row-sm">
                            <div class="col-xl-12 col-lg-12 col-md-12 chat-box">
                                <div class="cardak">
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div id="frame">
                                                <div id="sidepanel">
                                                    <div id="profile">
                                                        <div class="wrap">
                                                            <?php if (@$get_user->profilePic && file_exists('uploads/users/' . @$get_user->profilePic)) { ?>
                                                                <img id="profile-img" src="<?= base_url('uploads/users/' . @$get_user->profilePic) ?>" class="online" alt="" />
                                                            <?php } else { ?>
                                                                <img id="profile-img" src="<?= base_url('uploads/no_pimage.png') ?>" class="online" alt="" />
                                                            <?php } ?>
                                                            <p>
                                                                <?php if (!empty($get_user->firstname)) {
                                                                    echo $get_user->firstname . ' ' . $get_user->lastname;
                                                                } else {
                                                                    echo $get_user->companyname;
                                                                } ?>
                                                            </p>
                                                            <div id="status-options">
                                                                <ul>
                                                                    <li id="status-online" class="active">
                                                                        <span class="status-circle"></span>
                                                                        <p>Online</p>
                                                                    </li>
                                                                    <li id="status-away">
                                                                        <span class="status-circle"></span>
                                                                        <p>Away</p>
                                                                    </li>
                                                                    <li id="status-busy">
                                                                        <span class="status-circle"></span>
                                                                        <p>Busy</p>
                                                                    </li>
                                                                    <li id="status-offline">
                                                                        <span class="status-circle"></span>
                                                                        <p>Offline</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if (@$_SESSION['afrebay']['userType'] == '1') {
                                                        $tab_heading = "All Customers";
                                                        $placeholder = "Search by Customer";
                                                    } else {
                                                        $tab_heading = "All Professionals";
                                                        $placeholder = "Search by Professional";
                                                    } ?>
                                                    <div id="contacts">
                                                        <div id="tabs">
                                                            <ul>
                                                                <li><a href="#tab-1"><?= $tab_heading ?></a></li>
                                                                <li><a href="#tab-2">Recent</a></li>
                                                            </ul>
                                                            <div id="tab-1">
                                                                <div id="search">
                                                                    <input type="text" id="search_professional_all" placeholder="<?= $placeholder ?>" />
                                                                </div>
                                                                <ul style="display: inline-block; width: 100%;">
                                                                    <?php
                                                                    if (@$_SESSION['afrebay']['userType'] == '1') {
                                                                        $userList = $this->db->query("SELECT * FROM users WHERE userType = '2' AND status = '1' AND email_verified = '1'")->result();
                                                                    } else {
                                                                        $userList = $this->db->query("SELECT * FROM users WHERE userType = '1' AND status = '1' AND email_verified = '1'")->result();
                                                                    }
                                                                    //echo "<pre>"; print_r($userList); die();
                                                                    if (!empty($userList)) {
                                                                        foreach ($userList as $user) { ?>
                                                                            <li class="contact contactList_all" onclick="return getuser('<?= $user->userId ?>');">
                                                                                <div class="wrap">
                                                                                    <span class="contact-status online"></span>
                                                                                    <?php if (@$user->profilePic && file_exists('uploads/users/' . @$user->profilePic)) { ?>
                                                                                        <img src="<?= base_url('uploads/users/' . @$user->profilePic) ?>" alt="" />
                                                                                    <?php } else { ?>
                                                                                        <img src="<?= base_url('uploads/no_pimage.png') ?>" alt="" />
                                                                                    <?php } ?>
                                                                                    <div class="meta">
                                                                                        <p class="name">
                                                                                            <?php if (empty($user->companyname)) {
                                                                                                echo ucfirst($user->firstname . ' ' . $user->lastname);
                                                                                            } else {
                                                                                                echo ucfirst($user->companyname);
                                                                                            } ?>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                    <?php }
                                                                    } ?>
                                                                </ul>
                                                            </div>
                                                            <div id="tab-2">
                                                                <div id="search">
                                                                    <input type="text" id="search_professional_recent" placeholder="<?= $placeholder ?>" />
                                                                </div>
                                                                <ul style="display: inline-block; width: 100%;">
                                                                    <?php
                                                                    $usrid = @$_SESSION['afrebay']['userId'];
                                                                    $recentList = $this->db->query("SELECT group_concat( distinct(chat_between)) as chat_between FROM chat WHERE INSTR(CONCAT(',', chat_between, ','), ',$usrid,') AND is_delete = 0")->row();
                                                                    $string = $recentList->chat_between;
                                                                    $array = explode(',', $string);
                                                                    $array = array_filter($array, function ($value) use ($usrid) {
                                                                        return $value != $usrid;
                                                                    });
                                                                    $array = array_unique($array);
                                                                    $result = implode(',', $array);
                                                                    //echo "<pre>"; print_r($result); die();
                                                                    if ($result != "") {
                                                                        $userList = $this->db->query("SELECT * FROM users WHERE userId IN (" . $result . ")")->result();
                                                                    } else {
                                                                        $userList = "";
                                                                    }

                                                                    if (!empty($userList)) {
                                                                        foreach ($userList as $user) { ?>
                                                                            <li class="contact contactList_recent" onclick="return getuser('<?= $user->userId ?>');">
                                                                                <div class="wrap">
                                                                                    <span class="contact-status online"></span>
                                                                                    <?php if (@$user->profilePic && file_exists('uploads/users/' . @$user->profilePic)) { ?>
                                                                                        <img src="<?= base_url('uploads/users/' . @$user->profilePic) ?>" alt="" />
                                                                                    <?php } else { ?>
                                                                                        <img src="<?= base_url('uploads/no_pimage.png') ?>" alt="" />
                                                                                    <?php } ?>
                                                                                    <div class="meta">
                                                                                        <p class="name">
                                                                                            <?php if (empty($user->companyname)) {
                                                                                                echo ucfirst($user->firstname . ' ' . $user->lastname);
                                                                                            } else {
                                                                                                echo ucfirst($user->companyname);
                                                                                            } ?>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                    <?php }
                                                                    } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <img class="chat-start-img" src="assets/images/chat-start-img.png">
                                                    <div id="message_list" style="height:100%;  overflow-y: scroll;overflow-y: hidden;">
                                                        </ul>
                                                    </div>
                                                    <div class="message-input">
                                                        <div class="wrap">
                                                            <input type="hidden" name="userfromid" id="userfromid" value="<?= $_SESSION['afrebay']['userId'] ?>" />
                                                            <input type="hidden" name="usertoid" id="usertoid" value="" />
                                                            <input type="hidden" name="postid" id="postid" value="" />
                                                            <input type="text" name="message" id="message" placeholder="Write your message..." />
                                                            <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                                                            <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="max-width: 100%;">
        <div class="modal-content">
            <?php
            $myBidList =  $this->db->query("SELECT postjob.post_title FROM job_bid JOIN postjob on job_bid.postjob_id = postjob.id where job_bid.user_id = '" . $_SESSION['afrebay']['userId'] . "' and job_bid.bidding_status = 'Accept' and job_bid.status = 'Active'")->result_array();
            if (!empty($myBidList)) {
                $i = 1;
                foreach ($myBidList as $value) { ?>
                    <p><?= $i . ". " . $value['post_title'] ?></p>
            <?php $i++;
                }
            } ?>
        </div>
    </div>
</div>

<style>
    .Custom_Chat_Design {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .Custom_Chat_Design .display-table-cell {
        padding: 10px 0 !important;
    }

    .Custom_Chat_Design .chat-box {
        padding: 0 10px !important;
    }

    .Custom_Chat_Design #frame {
        display: flex;
        flex-direction: row;
    }

    .Custom_Chat_Design #frame #sidepanel {
        float: none;
        min-width: auto;
        max-width: none;
        width: 40%;
    }

    .Custom_Chat_Design #frame .content {
        width: 60% !important;
    }

    .Custom_Chat_Design #frame .content .contact-profile {
        width: 100%;
        height: 50px !important;
        line-height: 50px !important;
        background: #ffffff;
        box-shadow: 0 10px 25px #c3c3c3;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 10px;
    }

    .Custom_Chat_Design #frame .content .contact-profile img {
        width: 35px !important;
        height: 35px !important;
        border-radius: 100%;
        object-fit: cover;
        margin: 0 15px 0 0 !important;
    }

    .Custom_Chat_Design #frame .content .contact-profile p {
        margin: 0 !important;
        font-size: 14px !important;
    }

    .Custom_Chat_Design .message-input {
        background: #fff;
        padding: 15px 0;
    }

    .Custom_Chat_Design .message-input .wrap {
        width: 100%;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .Custom_Chat_Design .message-input .wrap input {
        margin: 0 !important;
        width: calc(100% - 70px) !important;
    }

    .Custom_Chat_Design .message-input .wrap button {
        float: none !important;
        margin-left: 10px !important;
        width: 45px !important;
        line-height: 45px !important;
        height: 45px !important;
        margin-right: 0 !important;
    }

    .Custom_Chat_Design .ui-widget.ui-widget-content ul li a {
        font-size: 15px !important;
    }

    .message-input {
        display: none;
    }

    .chatList {
        display: block !important;
        text-align: center !important;
    }

    .showBidListContent {
        display: block !important;
        opacity: 1 !important;
        top: 58% !important;
        left: 8% !important;
    }

    .modal-dialog {
        max-width: 60% !important;
        margin: 0 !important;
        display: contents !important;
    }

    .modal-content {
        max-width: 80% !important;
    }

    .modal-content p {
        margin: 0px !important;
        padding: 4px 20px 0 20px !important;
    }

    .social-media {
        display: none;
    }

    .notificationv {
        left: 270px !important;
        top: 6px;
        font-size: 15px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .notificationf {
        left: 270px !important;
        top: 6px;
        font-size: 15px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .notificationv1 {
        left: 270px !important;
        top: 6px;
        font-size: 15px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .notificationf1 {
        left: 270px !important;
        top: 6px;
        font-size: 15px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .EachvChat {
        display: none;
    }

    .EachfChat {
        display: none;
    }

    #frame #sidepanel #profile .wrap p {
        font-size: 11px !important;
    }

    @media screen and (max-width: 425px) {
        .User_Sidemenu .hidden-xs.display-table-cell .navi ul li a {
            border-radius: 10px !important;
            margin-bottom: 10px !important;
        }

        .navi ul li:nth-child(3) a span {
            font-size: 11px !important;
        }

        .cover {
            display: none !important;
        }

        .User_Sidemenu .hidden-xs.display-table-cell .navi ul li.active a {
            border-radius: 10px !important;
        }

        .User_Sidemenu .hidden-xs.display-table-cell .navi ul li.active {
            box-shadow: none !important;
        }

        .navi ul li:nth-child(3) a span,
        .navi ul li:nth-child(4) a span {
            font-size: 10px !important;
        }
    }

    .ui-widget.ui-widget-content,
    .ui-tabs .ui-tabs-nav {
        border: none !important;
        margin: 0 !important;
        padding: 0 !important;
        background: none !important;
    }

    .ui-tabs .ui-tabs-nav li {
        width: 46% !important;
        background: #fff !important;
        border: none !important;
        margin: 0 0 0 10px !important;
        border-radius: 10px !important;
    }

    .ui-tabs .ui-tabs-nav li.ui-tabs-active {
        width: 46% !important;
        background: #000 !important;
        border: none !important;
        color: #fff !important;
        border-radius: 10px !important;
    }

    .ui-tabs .ui-tabs-nav .ui-tabs-anchor {
        color: #000;
        width: 100% !important;
        text-align: center !important;
    }

    #frame #sidepanel #contacts ul li.contact {
        height: 65px !important;
        border-radius: 10px !important;
    }

    .ui-tabs .ui-tabs-panel {
        padding: 10px !important;
    }

    .Chat_User #frame #sidepanel #contacts ul li.contact:hover {
        background: #00000060 !important;
    }

    .Chat_User #frame #sidepanel #search input {
        border-radius: 10px !important;
    }

    .ui-state-active a,
    .ui-state-active a:link,
    .ui-state-active a:visited {
        color: #fff !important;
    }
</style>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script>
    try {
        Typekit.load({
            async: true
        });
    } catch (e) {}
</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    var jq = jQuery.noConflict();
    jq(document).ready(function() {
        jq("#tabs").tabs();
    });
</script>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script>
    $(".messages").animate({
        scrollTop: $(document).height()
    }, "fast");
    $("#profile-img").click(function() {
        $("#status-options").toggleClass("active");
    });
    $(".expand-button").click(function() {
        $("#profile").toggleClass("expanded");
        $("#contacts").toggleClass("expanded");
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
        $("#status-options").removeClass("active");
    });

    function newMessage() {
        var userfromid = $('#userfromid').val();
        var usertoid = $('#usertoid').val();
        var postid = $('#postid').val();
        var message = $('#message').val();

        if ($.trim(message) == '') {
            return false;
        }
        $.ajax({
            url: '<?= base_url('user/dashboard/sent_message') ?>',
            type: 'POST',
            data: {
                userfromid: userfromid,
                usertoid: usertoid,
                postid: postid,
                message: message
            },
            dataType: 'json',
            success: function(returndata) {
                setInterval(function() {
                    getMessageCount();
                }, 5000);
                if (returndata.result == 1) {
                    $('<li class="sent">' + returndata.userpic + '<p>' + message + '</p></li>').appendTo($('.messages ul'));
                    $('#message').val(null);
                    $('.contact.active .preview').html('<span>You: </span>' + message);
                    $(".messages").scrollTop($(document).height());
                }
            }
        });
    }
    $("#message").mouseover(function() {
        $('.EachvChat').hide();
        $('.EachfChat').hide();
        setInterval(function() {
            getMessage();
            getMessageCount();
        }, 5000);
    });
    $(document).ready(function() {
        $('.EachvChat').hide();
        $('.EachfChat').hide();
        $('#search_professional_all').on('input', function(e) {
            let lists = document.querySelectorAll('.contactList_all')
            lists.forEach((list) => {
                if (!list.innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                    list.classList.add('d-none')
                } else {
                    list.classList.remove('d-none')
                }
            })
        })
        $('#search_professional_recent').on('input', function(e) {
            let lists = document.querySelectorAll('.contactList_recent')
            lists.forEach((list) => {
                if (!list.innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                    list.classList.add('d-none')
                } else {
                    list.classList.remove('d-none')
                }
            })
        })
    });

    function getMessage() {
        var userfromid = $('#userfromid').val();
        var usertoid = $('#usertoid').val();
        var postid = $('#postid').val();
        $.ajax({
            url: '<?= base_url('user/dashboard/showmessage_listS') ?>',
            type: 'POST',
            data: {
                userfromid: userfromid,
                usertoid: usertoid,
                postid: postid
            },
            dataType: 'json',
            success: function(result) {
                $('#message_list').html(result);
                $(".messages").scrollTop(10000000);
            }
        });
    }

    function getMessageCount() {
        var userfromid = $('#userfromid').val();
        var usertoid = $('#usertoid').val();
        var postid = $('#postid').val();
        $.ajax({
            url: '<?= base_url('user/dashboard/showmessageCountEach') ?>',
            type: 'POST',
            data: {
                userfromid: userfromid,
                usertoid: usertoid,
                postid: postid
            },
            dataType: 'json',
            success: function(result) {
                <?php if (@$_SESSION['afrebay']['userType'] == '2') { ?>
                    if (result.count > 0) {
                        $('.EachChatv').hide();
                        $('.EachvChat').show();
                        $('.EachvChat').text(result.count);
                    } else {
                        $('.EachvChat').hide();
                        $('.EachChatv').hide();
                    }
                <?php } else { ?>
                    if (result.count > 0) {
                        $('.EachChatf').hide();
                        $('.EachfChat').show();
                        $('.EachfChat').text(result.count);
                    } else {
                        $('.EachChatf').hide();
                        $('.EachfChat').hide();
                    }
                <?php } ?>
            }
        });
    }
    $('.submit').click(function() {
        newMessage();
    });
    $(window).on('keydown', function(e) {
        if (e.which == 13) {
            newMessage();
            return false;
        }
    });

    function getuser(usert_id, post_id) {
        var displayProduct = 3;
        $('#message_list').html(createSkeleton(displayProduct));

        function createSkeleton(limit) {
            var skeletonHTML = '';
            for (var i = 0; i < limit; i++) {
                skeletonHTML += '<div class="ph-item">';
                skeletonHTML += '<div class="ph-col-4">';
                skeletonHTML += '<div class="ph-picture"></div>';
                skeletonHTML += '</div>';
                skeletonHTML += '<div>';
                skeletonHTML += '<div class="ph-row">';
                skeletonHTML += '<div class="ph-col-12 big"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '</div>';
                skeletonHTML += '</div>';
                skeletonHTML += '</div>';
            }
            return skeletonHTML;
        }
        $('#usertoid').val(usert_id);
        $('#postid').val(post_id);
        $("#message_list").attr('class', '');
        $('#message_list').toggleClass('messageDetails' + usert_id);
        $.ajax({
            url: '<?= base_url('user/dashboard/showmessage_list') ?>',
            type: 'POST',
            data: {
                usert_id: usert_id,
                post_id: post_id
            },
            dataType: 'json',
            success: function(result) {
                $('#message_list').html(result);
                $(".messages").scrollTop(10000000);
                $('.message-input').show();
                $('#frame').addClass('chat_frame');
            }
        });
    }

    function openVideoCallWindow(fid) {
        var callPath = "<?php echo base_url('livevideo/video/'); ?>" + fid;
        window.open(callPath, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=20,width=600,height=450");
    }
    $(function() {
        $('#showBidList').mouseover(function() {
            $(".modal").addClass('showBidListContent');
        });

        $('#showBidList').mouseout(function() {
            $(".modal").removeClass('showBidListContent');
        });
    })
</script>