<?php $validation = session()->getFlashdata('validation') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $sysprofile['systitle']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('sysprofile/' . $sysprofile['syslogo']) ?>">

    <!-- App css -->
    <link href="<?= base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body class="account-body">

    <!-- Log In page -->
    <div class="row vh-100 ">
        <div class="col-12 align-self-center">
            <div class="auth-page">
                <div class="card auth-card shadow-lg">
                    <div class="card-body">
                        <div class="px-3">
                            <div class="auth-logo-box">
                                <a href="../analytics/analytics-index.html" class="logo logo-admin"><img src="<?= base_url('sysprofile/' . $sysprofile['syslogo']) ?>" height="55" alt="logo" class="auth-logo" style="border-radius: 16px; padding:8px"></a>
                            </div>
                            <!--end auth-logo-box-->

                            <div class="text-center auth-logo-text">
                                <h4 class="mt-0 mb-3 mt-5">Reset Password</h4>
                                <p class="text-muted mb-0"><?= $sysprofile['systitle']; ?></p>
                            </div>
                            <!--end auth-logo-text-->


                            <form class="form-horizontal auth-form my-4" action="<?= site_url('reset'); ?>" method="post">
                                <?= csrf_field() ?>
                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
                                <?php endif  ?>

                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
                                <?php endif  ?>

                                <input type="hidden" name="token" value="<?= $token; ?>">
                                <div class="form-group">
                                    <label for="username">Kata Sandi Baru</label>
                                    <div class="input-group mb-3">
                                        <span class="auth-form-icon">
                                            <i class="dripicons-lock"></i>
                                        </span>
                                        <input type="password" name="newPassword" class="form-control" placeholder="Enter your New Password" required>
                                    </div>
                                    <small class="form-text text-danger"><?= $validation ? $validation->showError('newPassword') : '' ?></small>
                                </div>
                                <!--end form-group-->

                                <div class="form-group">
                                    <label for="username">Konfirmasi Kata Sandi Baru</label>
                                    <div class="input-group mb-3">
                                        <span class="auth-form-icon">
                                            <i class="dripicons-lock"></i>
                                        </span>
                                        <input type="password" name="confirmNewPass" class="form-control" placeholder="Re-Enter your New Password" required>
                                    </div>
                                    <small class="form-text text-danger"><?= $validation ? $validation->showError('confirmNewPass') : '' ?></small>
                                </div>
                                <!--end form-group-->

                                <div class="form-group row mt-4">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-switch switch-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                            <!-- <label class="custom-control-label text-muted" for="customSwitchSuccess">Remember me</label> -->
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end form-group-->

                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button type="submit" class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">Simpan <i class="fas fa-save ml-1"></i></button>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end form-group-->
                            </form>
                            <!--end form-->
                        </div>
                        <!--end /div-->

                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
                <!--end account-social-->
            </div>
            <!--end auth-page-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <!-- End Log In page -->


    <!-- jQuery  -->
    <script src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/metisMenu.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/waves.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/jquery.slimscroll.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url(); ?>/assets/js/app.js"></script>

</body>

</html>