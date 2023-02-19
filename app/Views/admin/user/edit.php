<?= $this->extend('admin') ?>
<?= $this->section('main-contents') ?>

<!--start main content-->
<div class="container-fluid">

    <h4 class="page-title">
        <a href="<?= base_url("admin/user") ?>" class="btn btn-warning">
            <i class="la la-arrow-left"></i> Back
        </a>
    </h4>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit User</div>
                </div>
                <form method="POST"  action="<?php echo base_url("admin/user/".$data['id']); ?>" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $data['id'] ?>" name="id">
                    <div class="card-body">
                        <?php if (session()->has('msg')) : ?>
                            <div class="alert alert-success text-center" role="alert">
                                <?= session()->getFlashdata("msg") ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->has('err')) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?= session()->getFlashdata("err") ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div class="form-group text-center">
                                    <img src="<?= base_url() . "/frontend/images/user_gallery/original/" .$data['profile'] ?>"
                                         alt="<?= esc($data['name']) ?>" width="120" height="120" class="mb-1 rounded-circle border-danger">
                                    <div class="text-center w-100 d-flex justify-content-center ">
                                        <input type="file" name="profile" class="form-control-file input-solid" style="width: 190px;">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="mb-1">Full Name</p>
                                <input type="text" name="name" value="<?=$data["name"]?>" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="mb-1">Age</p>
                                <input type="number" name="age" value="<?=$data["age"]?>" class="form-control" placeholder="Enter Age">
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="mb-1">Email</p>
                                <input type="email" name="email" value="<?=$data["email"]?>" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="mb-1">Phone Number</p>
                                <input type="number"  name="phone_no" value="<?=$data["phone_no"]?>" class="form-control" placeholder="Enter Phone No">
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="mb-1">New Password</p>
                                <div class="toggle-password">
                                    <input type="password" name="password"   class="form-control" autocomplete="password" placeholder="*********">
                                    <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="mb-1">Confirm Password</p>
                                <div class="toggle-password">
                                    <input type="password" name="cpassword"   class="form-control" autocomplete="password" placeholder="*********" >
                                    <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-action text-center">
                        <button type="submit" class="btn btn-outline-primary">Submit</button
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!--end main content-->
<?= $this->endSection('main-contents') ?>
