<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Dashboard Monitoring System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= base_url('sysprofile/' . session()->get('syslogo')) ?>">

  <!-- Plugins css -->
  <link href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/plugins/select2/select2.min.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') ?>" rel="stylesheet"
    type="text/css" />
  <link href="<?= base_url('assets/plugins/timepicker/bootstrap-material-datetimepicker.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') ?>"
    rel="stylesheet" />


  <!-- App css -->
  <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/css/metisMenu.min.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/css/customize.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/plugins/multi-select/multi-select.css') ?>" media="screen" rel="stylesheet"
    type="text/css">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.dataTables.min.css') ?>">

  <!-- <link href="<?= base_url('assets/plugins/ticker/jquery.jConveyorTicker.css') ?>" rel="stylesheet" type="text/css" /> -->

  <?= $this->renderSection('css') ?>
</head>

<body>

  <!-- Top Bar Start -->
  <!-- header -->
  <?= $this->include('Lay/template-header') ?>
  <!-- header -->
  <!-- Top Bar End -->

  <div class="page-wrapper">
    <!-- Left Sidenav -->
    <!-- sidebar -->
    <?= $this->include('Lay/template-sidebar') ?>
    <!-- sidebar -->
    <!-- end left-sidenav-->

    <!-- Page Content-->
    <div class="page-content">
      <?php if (session()->getFlashdata('success')) : ?>
      <div style="margin-bottom:-7px" class="alert alert-success mt-3 mx-3" role="alert">
        <?= session()->getFlashdata('success') ?></div>
      <?php elseif (session()->getFlashdata('error')) :  ?>
      <div style="margin-bottom:-7px" class="alert alert-danger mt-3 mx-3" role="alert">
        <?= session()->getFlashdata('error') ?></div>
      <?php endif  ?>

      <!-- jQuery  -->
      <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
      <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

      <script src="<?= base_url('assets/plugins/moment/moment.js') ?>"></script>
      <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
      <script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
      <script src="<?= base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>"></script>
      <script src="<?= base_url('assets/plugins/timepicker/bootstrap-material-datetimepicker.js') ?>"></script>
      <script src="<?= base_url('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') ?>"></script>
      <script src="<?= base_url('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') ?>"></script>

      <script src="<?= base_url('assets/js/jquery.priceformat.min.js') ?>" type="text/javascript"></script>
      <script src="<?= base_url('assets/js/jquery.chained.js') ?>"></script>

      <script src="<?= base_url('assets/plugins/multi-select/jquery.multi-select.js') ?>" type="text/javascript">
      </script>

      <?= $this->renderSection('content'); ?>

      <!-- <script src="<?= base_url('assets/plugins/ticker/jquery.jConveyorTicker.min.js') ?>"></script>
      <script src="<?= base_url('assets/pages/jquery.crypto-news.init.js') ?>"></script> -->
      <script src="<?= base_url('assets/js/metisMenu.min.js') ?>"></script>
      <script src="<?= base_url('assets/js/waves.min.js') ?>"></script>
      <script src="<?= base_url('assets/js/jquery.slimscroll.min.js') ?>"></script>
      <script src="<?= base_url('assets/plugins/sweet-alert2/sweetalert2.min.js') ?>"></script>

      <script src="<?= base_url('assets/pages/jquery.forms-advanced.js') ?>"></script>
      <script src="<?= base_url('assets/plugins/datatables/dataTables.min.js') ?>"></script>
      <!-- App js -->
      <script src="<?= base_url('assets/js/app.js') ?>"></script>
      <script type="text/javascript">
      $('.numeric').priceFormat({
        thousandsSeparator: '.',
        prefix: '',
        centsLimit: 0,
      });

      $("#child-chain").chained("#parent-chain");

      $('#multiselect').multiSelect({
        keepOrder: true
      });

      $("#checkall").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
      });
      </script>
      <!-- custom script -->
      <?= $this->renderSection('js'); ?>


      <!-- footer -->
      <?= $this->include('Lay/template-footer') ?>
      <!-- footer -->
    </div>
  </div>
</body>

</html>