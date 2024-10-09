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
            <li class="breadcrumb-item active">Group</li>
            <li class="breadcrumb-item active">Group Access</li>
          </ol>
        </div>
        <h4 class="page-title">Group Access</h4>
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

                <a href="<?= site_url('setgroup'); ?>" class="btn btn-sm btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left"></i> Kembali </a>
                <br>
                <h4 class="page-title"><?= $data_group['nama']; ?></h4>
                <form method="post" action="<?= site_url('setgroup/access/' . $data_group['id']) ?>">
                  <?= csrf_field() ?>
                  <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                      <?php foreach ($data_access as $row) { ?>
                        <tr>
                          <td>
                            <input type="checkbox" value="<?= $row['id'] ?>" class="mr-2" name="access_id[]" <?= in_array($row['id'], $slcaccess) ? 'checked' : '' ?>>
                            <h5 class="d-inline-block"><?= $row['nama_tree'] ?></h5>
                          </td>
                        </tr>
                      <?php }; ?>
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