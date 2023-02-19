<?= $this->extend('admin') ?>
<?= $this->section('main-contents') ?>

<div class="row d-flex justify-content-center" style="margin-top:-20px">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">User Ads Table</div>
                <a href="<?= base_url("post-ads") ?>" class="btn btn-info">
                    <i class="la la-plus-circle"></i> Add User Ads
                </a>
            </div>

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
                <?php if ($data): ?>
                    <form action="<?= base_url("admin/user-ads") ?>" method="post" >
                        <div class="form-group form-inline">
                            <label for="smallSelect" class="form-label mx-1 text-dark">Show Results : </label>
                            <select  onchange='this.form.submit()' class="form-control form-control-sm text-dark" name="result_number"  >
                                <option  <?php if($pager->getPerPage()==5){echo "selected";}?> >5</option>
                                <option  <?php if($pager->getPerPage()==10){echo "selected";}?>>10</option>
                                <option  <?php if($pager->getPerPage()==15){echo "selected";}?>>15</option>
                                <option  <?php if($pager->getPerPage()==20){echo "selected";}?>>20</option>
                                <option  <?php if($pager->getPerPage()==25){echo "selected";}?>>25</option>
                                <option  <?php if($pager->getPerPage()==30){echo "selected";}?>>30</option>
                            </select>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-head-bg-primary table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th>NickName</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>State</th>
                                <th>Ads Category</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                
                                <tr>
                                    
                                    <td>
                                        <?= esc(ucwords($value['nickname'])) ?>
                                    </td>
                                    <td>
                                        <?= esc(ucwords($value['email'])) ?>
                                    </td>
                                    <td>
                                        <?= esc(ucwords($value['phone_no'])) ?>
                                    </td>
                                    <td>
                                        <?= esc(ucwords($value['state'])) ?>
                                    </td>
                                    <td>
                                        <?= esc(ucwords($value['ads_category'])) ?>
                                    </td>
                                    
                                    <td><?= date("D d-m-Y", strtotime($value['created_at'])) ?></td>
                                    
                                    <td>
                                        <a href="<?= base_url()."/admin/user-ads/delete/".$value['id'] ?>"
                                           class="btn btn-sm btn btn-rounded btn-danger my-1">
                                            <i class="la la-trash"></i> Delete
                                        </a>
                                        <a href="<?= base_url()."/".strtolower(url_title($value['ads_category']))."/".strtolower(url_title($value['city']))."/".$value['ads_title_url'] ?>"
                                           class="btn btn-sm btn btn-rounded btn-warning my-1">
                                            <i class="la la-eye"></i> View
                                        </a>
                                        <a href="<?= base_url()."/post-ads/".$value['id'] ?>"
                                           class="btn btn-sm btn btn-rounded btn-success my-1" style="text-decoration: none">
                                            <i class="la la-pencil"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php  endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($pager) :?>
                        <?php $pagi_path='admin/user-ads'; ?>
                        <?php $pager->setPath($pagi_path); ?>
                        <?php echo $pager->links() ?>
                    <?php endif ?>
                <?php else: ?>
                    <h6>
                        <div class="alert alert-warning text-center"><i class="la la-warning"></i> No Record found
                            yet
                        </div>
                    </h6>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--end main content-->
<?= $this->endSection('main-contents') ?>
