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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <form method="get" action="<?= site_url('setaccess') ?>">
            <div class="row">
              <div class="col-lg-2">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama" value="<?= $filterNama; ?>" />
              </div>
              <div class="col-lg-3">
                <button class="btn btn-sm btn-primary" style="margin-top:28px;"><i class="fa fa-search"></i> Cari</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

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
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <tbody>
                    <?php foreach ($access as $row) { ?>
                      <tr>
                        <td>
                          <h5 class="d-inline-block"><?= $row['nama_tree'] ?></h5>
                        </td>
                        <td width="5%">
                          <a href="<?= site_url('setaccess/' . $row['id']); ?>" class="btn  btn-success" style="padding: 2px 6px; margin: 0 3px"><i class=" fa fa-edit"></i></a>
                        </td>
                      </tr>
                    <?php }; ?>
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