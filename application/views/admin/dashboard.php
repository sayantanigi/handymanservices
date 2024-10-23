<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="page-title">Admin <?= $heading?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-sm-6 col-12">
                <a href="<?= admin_url('users')?>">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </span>
                                <div class="dash-widget-info">
                                    <h3><?= count($total_user)?></h3>
                                    <h6 class="text-dark">Users</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-sm-6 col-12">
                <a href="<?= admin_url('category')?>">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-primary">
                                    <i class="fas fa-list"></i>
                                </span>
                                <div class="dash-widget-info">
                                    <h3><?= count($total_category)?></h3>
                                    <h6 class="text-dark">Categories</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-sm-6 col-12">
                <a href="<?= admin_url('career')?>">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-primary">
                                    <i class="fa fa-graduation-cap"></i>
                                </span>
                                <div class="dash-widget-info">
                                    <h3><?= count($total_career)?></h3>
                                    <h6 class="text-dark">Career Tips</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-sm-6 col-12">
                <a href="<?= admin_url('adsense')?>">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-primary">
                                    <i class="fa fa-ad"></i>
                                </span>
                                <div class="dash-widget-info">
                                    <h3><?= count($total_adsense)?></h3>
                                    <h6 class="text-dark">Ad Sense</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</div>
