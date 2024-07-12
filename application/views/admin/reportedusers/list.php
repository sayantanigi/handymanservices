<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right">
                    <!-- <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                    <i class="fas fa-filter"></i>
                </a> -->
                <!-- <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
            </a> -->
        </div>
    </div>
</div>
<div class="card filter-card">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                    <?php
                    if(!empty($reportuserList)) {
                        $i = 1;
                        foreach ($reportuserList as $value) {
                            $touserDetails = $this->db->query("SELECT * FROM users WHERE userId = '".$value['to_user_id']."'")->row();
                            if(!empty($touserDetails->companyname)) {
                                $tousername = $touserDetails->companyname;
                            } else {
                                $tousername = $touserDetails->firstname." ".$touserDetails->lastname;
                            }
                            $fromUserDetails = $this->db->query("SELECT * FROM users WHERE userId = '".$value['from_user_id']."'")->row();
                            if(!empty($fromUserDetails->companyname)) {
                                $fromUsername = $fromUserDetails->companyname;
                            } else {
                                $fromUsername = $fromUserDetails->firstname." ".$fromUserDetails->lastname;
                            }
                        ?>
                        <p><?= $i.' <a href="javascript:void(0)">'.$fromUsername.'</a> reported <a href="javascript:void(0)">'.$tousername.'</a> for "'.$value['reason'].'" this reson.';?> </p>
                        <?php $i++; } } else { ?>
                        <p>No data found</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/user.js')?>"></script>