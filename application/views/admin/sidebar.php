<?php
$get_setting = $this->Crud_model->get_single('setting');
$seg2 = $this->uri->segment(2);
?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="<?php echo admin_url(); ?>dashboard">
            <img src="<?= base_url(); ?>uploads/logo/<?= $get_setting->logo ?>" class="img-fluid" alt="">
        </a>
    </div>

    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li <?php if ($seg2 == 'dashboard') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class" <?php if ($seg2 == 'dashboard') { ?>class="active" <?php } ?>>
                        <a href="<?= admin_url('dashboard') ?>" class="adminMenu_class1">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'dashboard'")->row();
                        if(!empty($gettooltile)) { ?>
                        <i class="fa fa-question faicon_style" onclick="showTooltip('dashboard')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'category') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url('category') ?>" class="adminMenu_class1">
                            <i class="fa fa-list"></i>
                            <span>Categories</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'category'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('category')"></i>
                        <?php } ?>
                    </span>
                </li>
                <!-- <li <?php if ($seg2 == 'sub_category') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url('sub_category') ?>" class="adminMenu_class1">
                            <i class="fab fa-buffer"></i>
                            <span>Subcategories</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'sub_category'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('sub_category')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'specialist') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url('specialist') ?>" class="adminMenu_class1">
                            <i class="fa fa-puzzle-piece"></i>
                            <span>Skill Set</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'specialist'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('specialist')"></i>
                        <?php } ?>
                    </span>
                </li> -->
                <li <?php if ($seg2 == 'banner') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url('banner') ?>" class="adminMenu_class1">
                            <i class="fas fa-image"></i>
                            <span>Sliders and Banners</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'banner'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('banner')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'manage_cms') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url('manage_cms') ?>" class="adminMenu_class1">
                            <i class="fas fa-circle"></i>
                            <span>Content Management</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'manage_cms'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('manage_cms')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'post_job') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url(); ?>post_job" class="adminMenu_class1">
                            <i class="fas fa-star"></i>
                            <span>Job Posts</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'post_job'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('post_job')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'chat') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url(); ?>chat" class="adminMenu_class1">
                            <i class="fab fa-rocketchat"></i>
                            <span>Messages</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'chat'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('chat')"></i>
                        <?php } ?>
                    </span>
                </li>
                <!-- <li <?php if ($seg2 == 'jobsbidding') { ?>class="active"<?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url('jobsbidding') ?>" class="adminMenu_class1">
                            <i class="far fa-calendar-check"></i>
                            <span> Jobs Bidding</span>
                        </a>
                    </span>
                </li> -->
                <li <?php if ($seg2 == 'users') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url(); ?>users" class="adminMenu_class1">
                            <i class="fas fa-user"></i>
                            <span>Users</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'users'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('users')"></i>
                        <?php } ?>
                    </span>
                </li>
                <!-- <li <?php if ($seg2 == 'reportedusers') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url(); ?>reportedusers" class="adminMenu_class1">
                            <i class="fa fa-flag"></i>
                            <span>Reported Users</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'reportedusers'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('reportedusers')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'our-services') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url(); ?>our-services" class="adminMenu_class1">
                            <i class="fas fa-bullhorn"></i>
                            <span>Our Services</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'our-services'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('our-services')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'company-logo') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url(); ?>company-logo" class="adminMenu_class1">
                            <i class="fa fa-handshake"></i>
                            <span>Partner Companies</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'company-logo'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('company-logo')"></i>
                        <?php } ?>
                    </span>
                </li> -->
                <li <?php if ($seg2 == 'career') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url(); ?>career" class="adminMenu_class1">
                            <i class="fa fa-graduation-cap"></i>
                            <span>Career Tips</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'career'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('career')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'adsense') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url(); ?>adsense" class="adminMenu_class1">
                            <i class="fa fa-ad"></i>
                            <span>AdSense</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'adsense'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('adsense')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'tooltips') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url('tooltips') ?>" class="adminMenu_class1">
                            <i class="fa fa-info"></i>
                            <span>Tooltips</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'tooltips'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('tooltips')"></i>
                        <?php } ?>
                    </span>
                </li>
                <li <?php if ($seg2 == 'setting') { ?>class="active" <?php } ?>>
                    <span class="adminMenu_class">
                        <a href="<?= admin_url('setting') ?>" class="adminMenu_class1">
                            <i class="fas fa-cog"></i>
                            <span>Site Settings</span>
                        </a>
                        <?php
                        $gettooltile = $this->db->query("SELECT * FROM manage_tooltips WHERE menu_name = 'setting'")->row();
                        if(!empty($gettooltile)) { ?>
                            <i class="fa fa-question faicon_style" onclick="showTooltip('setting')"></i>
                        <?php } ?>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="viewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div id="show_description"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.faicon_style {
    width: 22px !important;
    height: 22px !important;
    background: #000 !important;
    border-radius: 15px !important;
    font-size: 12px !important;
    text-align: center !important;
    display: flex !important;
    align-items: center;
    justify-content: center;
    color: #fff !important;
    cursor: pointer;
}

.adminMenu_class {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: space-between !important;
    /* background-color: #2892ff; */
    border-radius: 10px;
    padding: 10px 20px;
    position: relative;
    transition: all 0.2s ease-in-out 0s;
}

.adminMenu_class a {
    padding: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.adminMenu_class a span {
    margin-left: 10px !important;
}

.adminMenu_class1 {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: flex-start !important;
}
#sidebar-menu .active {background-color: #2892ff;}
#show_description img {width: 100% !important;}
</style>
<script>
function showTooltip(id) {
    var tooltip = id;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>admin/tooltips/get_tooltip",
        data: {tooltip: tooltip},
        success: function(returndata) {
            var obj = $.parseJSON(returndata);
            $(".modal-title").html(obj.menu_name);
            $("#show_description").html(obj.description);
            $("#viewModal").modal('show');
        }
    })
}
</script>