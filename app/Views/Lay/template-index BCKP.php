<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard Monitoring System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/logo/favicon.ico') ?>">

    <!-- Plugins css -->
    <link href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/plugins/select2/select2.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/plugins/timepicker/bootstrap-material-datetimepicker.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') ?>" rel="stylesheet" />

    <!-- App css -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/metisMenu.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/customize.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/plugins/multi-select/multi-select.css') ?>" media="screen" rel="stylesheet" type="text/css">

    <link href="<?= base_url('assets/plugins/ticker/jquery.jConveyorTicker.css') ?>" rel="stylesheet" type="text/css" />
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
                <div style="margin-bottom:-7px" class="alert alert-success mt-3 mx-3" role="alert"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')) :  ?>
                <div style="margin-bottom:-7px" class="alert alert-danger mt-3 mx-3" role="alert"><?= session()->getFlashdata('error') ?></div>
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

            <script src="<?= base_url('assets/vendor/jquery-priceformat/jquery.priceformat.min.js') ?>" type="text/javascript"></script>
            <script src="<?= base_url('assets/vendor/jquery-chained/jquery.chained.js') ?>"></script>

            <script src="<?= base_url('assets/plugins/multi-select/jquery.multi-select.js') ?>" type="text/javascript"></script>


            <!-- Plugins js -->
            <script src="<?= base_url('assets/plugins/apexcharts/apexcharts.min.js') ?>"></script>

            <?= $this->renderSection('content'); ?>

            <script src="<?= base_url('assets/plugins/ticker/jquery.jConveyorTicker.min.js') ?>"></script>
            <script src="<?= base_url('assets/pages/jquery.crypto-news.init.js') ?>"></script>
            <script src="<?= base_url('assets/js/metisMenu.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/waves.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/jquery.slimscroll.min.js') ?>"></script>

            <script src="<?= base_url('assets/pages/jquery.forms-advanced.js') ?>"></script>
            <!-- App js -->
            <script src="<?= base_url('assets/js/app.js') ?>"></script>
            <script type="text/javascript">
                $('.numeric').priceFormat({
                    thousandsSeparator: '.',
                    prefix: '',
                    centsLimit: 0,
                });

                $("#child-chain").chained("#parent-chain");

                $('#nab_awal, #unit_awal').change(function() {
                    let nab_awal = $('#nab_awal').val();
                    let unit_awal = $('#unit_awal').val();

                    let result = nab_awal * unit_awal;
                    $('#penyertaan_awal').val(result);
                });

                $('#nab_pasar, #unit_pasar').change(function() {
                    let nab_pasar = $('#nab_pasar').val();
                    let unit_pasar = $('#unit_pasar').val();

                    let result = nab_pasar * unit_pasar;
                    $('#penyertaan_pasar').val(result);
                });

                $('#jangka_waktu, #start').change(function() {
                    let jangka_waktu = $("#jangka_waktu").val();
                    let startArray = $("#tanggal_buka").val().split('-');
                    let startdate = startArray[2] + '-' + startArray[1] + '-' + startArray[0];

                    let d = new Date(startdate);
                    // console.log('start', startdate);
                    // console.log('end', d.setDate(d.getDate() + parseInt(jangka_waktu)));
                    d.setDate(d.getDate() + parseInt(jangka_waktu));
                    let enddate = (d.getDate() + 1) + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
                    console.log('end', enddate)
                    $("#jatuh_tempo").val(enddate);
                })

                $('#multiselect').multiSelect({
                    keepOrder: true
                });

                $('#nab_awal, #unit_awal').change(function() {
                    let nab_awal = $('#nab_awal').val().replace('.', '').replace('.', '').replace('.', '');
                    let unit_awal = $('#unit_awal').val().replace('.', '').replace('.', '');

                    let result = nab_awal * unit_awal;
                    $('#penyertaan_awal').val(result).priceFormat({
                        thousandsSeparator: '.',
                        prefix: '',
                        centsLimit: 0,
                    });
                });

                $('#nab_pasar, #unit_pasar').change(function() {
                    let nab_pasar = $('#nab_pasar').val().replace('.', '').replace('.', '').replace('.', '');
                    let unit_pasar = $('#unit_pasar').val().replace('.', '').replace('.', '');

                    let result = nab_pasar * unit_pasar;
                    $('#penyertaan_pasar').val(result).priceFormat({
                        thousandsSeparator: '.',
                        prefix: '',
                        centsLimit: 0,
                    });
                });
            </script>

            <!-- footer -->
            <?= $this->include('Lay/template-footer') ?>
            <!-- footer -->
        </div>
    </div>
</body>

</html>