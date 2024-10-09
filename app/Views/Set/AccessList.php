<?= $this->extend('Lay/template-index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="float-right">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">User Access</li>
            <li class="breadcrumb-item active">Akses</li>
          </ol>
        </div>
        <h4 class="page-title">Akses</h4>
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

                <a href="<?= site_url('setaccess/new') ?>" class="btn btn-sm btn-primary float-left" style="margin-bottom: 20px;"><i class="fa fa-plus"></i> Tambah</a>
                <br>
                <?= csrf_field() ?>
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <tbody>
                    <!-- parent -->
                    <?php foreach ($access as $row) : ?>
                      <tr class="parent" data-id="<?= $row['id'] ?>">
                        <td>
                          <h5 class="d-inline-block"><span class="toggle">&#9658;</span> <?= $row['nama'] ?></h5>
                        </td>
                        <td width="5%">
                          <a href="<?= site_url('setaccess/' . $row['id']); ?>" class="btn btn-success" style="padding: 2px 6px; margin: 0 3px"><i class="fa fa-edit"></i></a>
                        </td>
                      </tr>

                      <!-- sub -->
                      <?php if (!empty($row['sub'])) foreach ($row['sub'] as $rowsub) : ?>
                        <tr class="sub parent-<?= $row['id'] ?>" data-id="<?= $rowsub['id'] ?>">
                          <td style="padding-left: 30px;">
                            <h5 class="d-inline-block"><span class="toggle">&#9658;</span><?= $rowsub['nama'] ?></h5>
                          </td>
                          <td width="5%">
                            <a href="<?= site_url('setaccess/' . $rowsub['id']); ?>" class="btn btn-success" style="padding: 2px 6px; margin: 0 3px"><i class="fa fa-edit"></i></a>
                          </td>
                        </tr>

                        <!-- child -->
                        <?php if (!empty($rowsub['child'])) foreach ($rowsub['child'] as $rowchild) : ?>
                          <tr class="child sub-<?= $rowsub['id'] ?>">
                            <td style="padding-left: 60px;">
                              <h5 class="d-inline-block"><?= $rowchild['nama'] ?></h5>
                            </td>
                            <td width="5%">
                              <a href="<?= site_url('setaccess/' . $rowchild['id']); ?>" class="btn btn-success" style="padding: 2px 6px; margin: 0 3px"><i class="fa fa-edit"></i></a>
                            </td>
                          </tr>
                        <?php endforeach ?>
                        <!-- end child -->

                      <?php endforeach ?>
                      <!-- end sub -->

                    <?php endforeach ?>
                    <!-- end parent -->
                  </tbody>
                </table>


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

<?= $this->section('css') ?>
<link href="<?= base_url('assets/plugins/listree/listree.min.css') ?>" rel="stylesheet" type="text/css">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/plugins/listree/listree.umd.min.js') ?>"></script>
<script>
  $(document).ready(function() {
    $('tr.parent, tr.sub').on('click', function(e) {
      // Prevent the click event from triggering if the target is a link
      if ($(e.target).is('a, i')) {
        return;
      }

      var targetId = $(this).data('id');
      var toggleIcon = $(this).find('.toggle');

      // Toggle the icon
      if (toggleIcon.html() === '►') {
        toggleIcon.html('▼');
      } else {
        toggleIcon.html('►');
      }

      // Find and toggle visibility of sub and child rows
      $('.parent-' + targetId + ', .sub-' + targetId).each(function() {
        $(this).toggle();

        // If hiding, ensure all children are hidden too
        if ($(this).is(':hidden')) {
          $(this).find('.toggle').html('►');
          var subTargetId = $(this).data('id');
          $('.sub-' + subTargetId).hide();
        }
      });
    });
  });
</script>
<?= $this->endSection() ?>