<?= $this->extend('Lay/template-index'); ?>
<?= $this->section('content'); ?>

<?php $validation = session()->getFlashdata('validation') ?>

<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>Setting</a></li>
                        <li class="breadcrumb-item active">Reset</li>
                    </ol>
                </div>
                <h4 class="page-title">Reset Password</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">

        <!--col-->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="table-responsive">
                                <form method="post" action="<?= site_url('setusermanagement/resetself/' . $data['id']); ?>">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <?= csrf_field() ?>
                                        <tr>
                                            <td>Nama</td>
                                            <td><?= $data['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= $data['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Password Lama</td>
                                            <td>
                                                <input class="form-control" type="password" name="oldPassword" value="<?= old('oldPassword') ?>" required />
                                                <small class="form-text text-danger"><?= $validation ? $validation->showError('oldPassword') : '' ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Password Baru</td>
                                            <td>
                                                <input class="form-control" type="password" name="newPassword" value="<?= old('newPassword') ?>" required />
                                                <small class="form-text text-danger"><?= $validation ? $validation->showError('newPassword') : '' ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>Konfirmasi Password Baru</td>
                                            <td>
                                                <input class="form-control" type="password" name="confirmNewPass" value="<?= old('confirmNewPass') ?>" required />
                                                <small class="form-text text-danger"><?= $validation ? $validation->showError('confirmNewPass') : '' ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                            </td>
                                        </tr>

                                    </table>
                                </form>

                            </div>
                        </div>
                        <!--end card-body-->


                    </div>
                    <!--end card-->
                </div><!-- end col-->
            </div>
            <!--end row-->


        </div>
        <!--end col-->

    </div>
    <!--end row-->

</div><!-- container -->
<?= $this->endSection('content'); ?>