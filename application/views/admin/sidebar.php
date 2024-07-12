<?php
	$get_setting=$this->Crud_model->get_single('setting');
	$seg2 =$this->uri->segment(2);
?>
<div class="sidebar" id="sidebar">
	<div class="sidebar-logo">
		<a href="<?php echo admin_url();?>dashboard">
			<img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" class="img-fluid" alt="">
		</a>
</div>
<div class="sidebar-inner slimscroll">
	<div id="sidebar-menu" class="sidebar-menu">
		<ul>
			<li <?php if ($seg2 =='dashboard') {?>class="active"<?php }?>>
				<a href="<?= admin_url('dashboard')?>"><i class="fas fa-columns"></i> <span>Dashboard</span></a>
			</li>
			<li <?php if ($seg2 =='category') {?>class="active"<?php }?>>
				<a href="<?= admin_url('category')?>"><i class="fas fa-layer-group"></i> <span>Categories</span></a>
			</li>
			<li <?php if ($seg2 =='sub_category') {?>class="active"<?php }?>>
				<a href="<?= admin_url('sub_category')?>"><i class="fab fa-buffer"></i> <span>Subcategories</span></a>
			</li>
			<li <?php if ($seg2 =='specialist') {?>class="active"<?php }?>>
				<a href="<?= admin_url('specialist')?>"><i class="fa fa-puzzle-piece"></i> <span>Skill Set</span></a>
			</li>
			<li <?php if ($seg2 =='banner') {?>class="active"<?php }?>>
				<a href="<?= admin_url('banner')?>"><i class="fas fa-image"></i> <span>Sliders and Banners</span></a>
			</li>
			<li <?php if ($seg2 =='manage_cms') {?>class="active"<?php }?>>
				<a href="<?= admin_url('manage_cms')?>"><i class="fas fa-circle"></i> <span>Content Management</span></a>
			</li>
			<li <?php if ($seg2 =='post_job') {?>class="active"<?php }?>>
				<a href="<?=admin_url(); ?>post_job"><i class="fas fa-star"></i> <span>Job Posts</span></a>
			</li>
			<li <?php if ($seg2 =='chat') {?>class="active"<?php }?>>
				<a href="<?=admin_url(); ?>chat"><i class="fab fa-rocketchat"></i> <span>Messages</span></a>
			</li>
			<li <?php if ($seg2 =='jobsbidding') {?>class="active"<?php }?>>
				<a href="<?= admin_url('jobsbidding')?>"><i class="far fa-calendar-check"></i> <span> Jobs Bidding</span></a>
			</li>
			<li <?php if ($seg2 =='users') {?>class="active"<?php }?>>
				<a href="<?=admin_url(); ?>users"><i class="fas fa-user"></i> <span>Users</span></a>
			</li>
            <li <?php if ($seg2 =='reportedusers') {?>class="active"<?php }?>>
				<a href="<?=admin_url(); ?>reportedusers"><i class="fas fa-user"></i> <span>Reported Users</span></a>
			</li>
			<li <?php if ($seg2 =='our-services') {?>class="active"<?php }?>>
				<a href="<?=admin_url(); ?>our-services"><i class="fas fa-bullhorn"></i> <span>Our Services</span></a>
			</li>
			<li <?php if ($seg2 =='company-logo') {?>class="active"<?php }?>>
				<a href="<?=admin_url(); ?>company-logo"><i class="fas fa-image"></i> <span>Partner Companies</span></a>
			</li>
			<li <?php if ($seg2 =='career') {?>class="active"<?php }?>>
				<a href="<?=admin_url(); ?>career"><i class="fa fa-graduation-cap"></i> <span>Career Tips</span></a>
			</li>
			<li <?php if ($seg2 =='adsense') {?>class="active"<?php }?>>
				<a href="<?=admin_url(); ?>adsense"><i class="fa fa-graduation-cap"></i> <span>AdSense</span></a>
			</li>
			<li <?php if ($seg2 =='setting') {?>class="active"<?php }?>>
				<a href="<?= admin_url('setting')?>"><i class="fas fa-cog"></i> <span>Site Settings</span></a>
			</li>
		</ul>
	</div>
</div>
</div>
