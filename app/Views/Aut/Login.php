<?php $validation = session()->getFlashdata('validation') ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?= $sysprofile['systitle']; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= base_url('sysprofile/' . $sysprofile['syslogo']); ?>">

  <!-- App css -->
  <link href="<?= base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('/assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('/assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <a href="../analytics/analytics-index.html" class="logo logo-admin"><img
                    src="<?= base_url('sysprofile/' . $sysprofile['syslogo']) ?>" height="55" alt="logo"
                    class="auth-logo" style="border-radius: 16px; padding:8px"></a>
              </div>
              <!--end auth-logo-box-->

              <div class="text-center auth-logo-text">
                <h4 class="mt-0 mb-3 mt-5">Login</h4>
                <p class="text-muted mb-0"><?= $sysprofile['systitle']; ?></p>
              </div>
              <!--end auth-logo-text-->

              <form action="signin" method="post">
                <!-- login menggunakan microsoft -->
                <div class="form-group row">
                  <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-block btn-dark"><i class="fab fa-microsoft"></i> Login with
                      Microsoft</a>
                  </div>
                </div>
              </form>



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

</body>

</html>