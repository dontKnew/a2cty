<?= $this->extend('admin') ?>
<?= $this->section('main-contents') ?>

<!--start main content-->
<div class="container-fluid">

    <h4 class="page-title">Dashboard</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-stats card-warning">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-bullhorn"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category"> Escorts</p>
                                <h4 class="card-title"><?= $escort ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-dark">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-bar-chart"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category"> Categories </p>
                                <h4 class="card-title"><?= $category ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-success">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-bar-chart"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category"> Cities </p>
                                <h4 class="card-title"><?= $city ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-danger">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-bullhorn"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">  States </p>
                                <h4 class="card-title"><?= $state ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-primary">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-bullhorn"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category"> FAQs </p>
                                <h4 class="card-title"><?= $faqs ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-danger">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-bullhorn"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category"> Blogs</p>
                                <h4 class="card-title"><?= $blog ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 							<div class="col-md-3">
                                        <div class="card card-stats">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center icon-warning">
                                                            <i class="la la-pie-chart text-warning"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 d-flex align-items-center">
                                                        <div class="numbers">
                                                            <p class="card-category">Number</p>
                                                            <h4 class="card-title">150GB</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-stats">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="la la-bar-chart text-success"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 d-flex align-items-center">
                                                        <div class="numbers">
                                                            <p class="card-category">Revenue</p>
                                                            <h4 class="card-title">$ 1,345</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="la la-times-circle-o text-danger"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 d-flex align-items-center">
                                                        <div class="numbers">
                                                            <p class="card-category">Errors</p>
                                                            <h4 class="card-title">23</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="la la-heart-o text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 d-flex align-items-center">
                                                        <div class="numbers">
                                                            <p class="card-category">Followers</p>
                                                            <h4 class="card-title">+45K</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
    </div>

</div>
<!--end main content-->
<?= $this->endSection('main-contents') ?>
