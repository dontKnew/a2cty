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
                    <div class="card-title">Edit Ads Category</div>
                </div>
                <form method="POST"  action="<?php echo base_url("admin/ads-category/".$data['id']); ?>" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control input-solid" value="<?= $data["name"] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Thumbnail Image (size:100x150)</label>
                            <input type="file" name="thumbnail_image" accept="image/*" class="form-control input-solid">
                            <img style="object-fit:cover" src="<?=base_url()?>/frontend/images/ads_category/<?=$data['image_load']?>/<?= esc($data['thumbnail_image']) ?>" alt="<?=$data['name']?>" height="100" width="150" />
                        </div>
                        <div class="form-group">
                            <label>Image Load</label>
                            <select name="image_load" class="form-control input-solid" required>
                                <option value="compress"  <?= ($data["image_load"]=="compress")?"selected":""?> >Fast-Reduce Quality</option>
                                <option value="original" <?= ($data["image_load"]=="original")?"selected":""?> > Slow-Original Quality</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Status</label>
                            <select name="status" class="form-control input-solid" required>
                                <option value="Private"  <?= ($data["status"]=="Private")?"selected":""?> >Private</option>
                                <option value="Public" <?= ($data["status"]=="Public")?"selected":""?> > Public</option>
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
