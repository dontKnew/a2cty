<?= $this->extend('admin') ?>
<?= $this->section('main-contents') ?>

<!--start main content-->
<div class="container-fluid">

    <h4 class="page-title">
        <a href="<?= base_url("admin/ads-category") ?>" class="btn btn-warning">
            <i class="la la-arrow-left"></i> Back
        </a>
    </h4>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Ads Category</div>
                </div>
                <form method="POST"  action="<?php echo base_url("admin/ads-category/add"); ?>" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control input-solid" value="<?= old("name") ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Thumbanil Image(size:100x150)</label>
                            <input type="file" name="thumbnail_image" accept="image/*" class="form-control input-solid" required>
                        </div>
                        <div class="form-group">
                            <label>Image Load</label>
                            <select name="image_load" class="form-control input-solid" required>
                                <option value="compress"  <?= (old("image_load")=="compress")?"selected":""?> >Fast-Reduce Quality</option>
                                <option value="original" <?= (old("image_load")=="original")?"selected":""?> > Slow-Original Quality</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Status</label>
                            <select name="status" class="form-control input-solid" required>
                                <option value="Private"  <?= (old("status")=="Private")?"selected":""?> >Private</option>
                                <option value="Public" <?= (old("status")=="Public")?"selected":""?> > Public</option>
                            </select>
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
