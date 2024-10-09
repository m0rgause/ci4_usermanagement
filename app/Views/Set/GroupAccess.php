<?= $this->extend('Lay/template-index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="float-right">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>User Access</a></li>
            <li class="breadcrumb-item active">Role</li>
            <li class="breadcrumb-item active">Role Access</li>
          </ol>
        </div>
        <h4 class="page-title">Role Access</h4>
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

                <a href="<?= site_url('setgroup'); ?>" class="btn btn-sm btn-warning" style="margin-bottom: 20px;"><i
                    class="fa fa-arrow-left"></i> Kembali </a>
                <br>
                <h4 class="page-title"><?= $data_group['nama']; ?></h4>
                <form method="post" action="<?= site_url('setgroup/access/' . $data_group['id']) ?>">
                  <?= csrf_field() ?>
                  <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%"
                    cellspacing="0">
                    <tbody>
                      <!-- parent -->
                      <?php foreach ($data_access as $row) : ?>
                      <tr class="parent" data-id="<?= $row['id'] ?>">
                        <td>
                          <input type="checkbox" value="<?= $row['id'] ?>" id="<?= $row['id'] ?>" class="mr-2"
                            name="access_id[]" <?= in_array($row['id'], $slcaccess) ? 'checked' : '' ?>>
                          <h5 class="d-inline-block"><span class="toggle">&#9658;</span> <?= $row['nama'] ?></h5>
                        </td>
                      </tr>

                      <!-- sub -->
                      <?php if (!empty($row['sub'])) : ?>
                      <?php foreach ($row['sub'] as $rowsub) : ?>
                      <tr class="sub parent-<?= $row['id'] ?>" data-id="<?= $rowsub['id'] ?>">
                        <td style="padding-left: 30px;">
                          <input type="checkbox" value="<?= $rowsub['id'] ?>" id="<?= $rowsub['id'] ?>"
                            class="mr-2 <?= $row['id'] ?>" name="access_id[]"
                            <?= in_array($rowsub['id'], $slcaccess) ? 'checked' : '' ?>>
                          <h5 class="d-inline-block"><span class="toggle">&#9658;</span><?= $rowsub['nama'] ?></h5>
                        </td>
                      </tr>

                      <!-- child -->
                      <?php if (!empty($rowsub['child'])) : ?>


                      <?php foreach ($rowsub['child'] as $rowchild) : ?>
                      <tr class="child sub-<?= $rowsub['id'] ?>">
                        <td style="padding-left: 60px;">
                          <input type="checkbox" value="<?= $rowchild['id'] ?>" id="<?= $rowchild['id'] ?>"
                            class="mr-2 <?= $row['id'] ?> <?= $rowsub['id'] ?>" name="access_id[]"
                            <?= in_array($rowchild['id'], $slcaccess) ? 'checked' : '' ?>>
                          <h5 class="d-inline-block"><?= $rowchild['nama'] ?></h5>
                        </td>
                      </tr>
                      <?php endforeach ?>
                      <?php endif ?>
                      <!-- end child -->

                      <?php endforeach ?>
                      <?php endif ?>
                      <!-- end sub -->

                      <?php endforeach ?>
                      <!-- end parent -->

                    </tbody>
                  </table>

                  <div class="d-flex justify-content-start">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                  </div>
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

<?= $this->section('css') ?>
<style>
.parent,
.sub {
  cursor: pointer;
}
</style>

<?= $this->endSection('css') ?>

<?= $this->section('js') ?>
<script>
$(document).ready(function() {
  $('tr.parent, tr.sub').on('click', function(e) {
    // Prevent the click event from triggering if the target is a checkbox
    if ($(e.target).is('input[type="checkbox"]')) {
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

  $('.mr-2').on('click', function(e) {
    //checked or unchecked child
    let slc_value = $(e.target).val()
    let slc_checked = $('.' + slc_value).is(":checked") ? false : true;
    $('.' + slc_value).prop('checked', slc_checked);

    //checked parent
    /*let slc_class = $(e.target).attr('class');
    let slc_parent = slc_class.split(' ');
    slc_parent.map(parent => {
      $('#'+parent).prop('checked', true);
    })*/
  })
});
</script>
<?= $this->endSection() ?>