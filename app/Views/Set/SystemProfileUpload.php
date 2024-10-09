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
            <li class="breadcrumb-item active"><a>Parameter</a></li>
            <li class="breadcrumb-item active">System Profile</li>
            <li class="breadcrumb-item">Upload</li>
          </ol>
        </div>
        <h4 class="page-title">Upload</h4>
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
                <form method="post" action="<?= site_url('setsystemprofile/upload/' . $id) ?>" enctype="multipart/form-data">
                  <?= csrf_field() ?>
                  <a href="<?= site_url('setsystemprofile') ?>" class="btn btn-sm btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left"></i> Kembali </a>

                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <td>Logo</td>
                      <?php if ($data['syslogo'] != '') { ?>

                        <td><img src="<?= base_url('sysprofile/' . $data['syslogo']) ?>" style="width:250px;">
                          <a href="<?= site_url('setsystemprofile/upload/' . $id . '/delete') ?>" class=" btn btn-outline-danger" style="padding: 2px 6px; margin: 0 3px" onclick="return confirm('Data akan dihapus!')"><i class=" fa fa-trash"></i> hapus</a>
                        </td>

                      <?php } else { ?>

                        <td>
                          <input class="form-check-upload" type="file" name="logo" id="logo">
                          <small class="form-text text-danger"><?= $validation ? $validation : '' ?></small>
                        </td>

                      <?php }; ?>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>
                        <small class="form-text">
                          <ul>
                            <li>Ekstensi gambar harus berakhiran <b>jpeg/jpg/png</b>.</li>
                            <li>Maksimal ukuran gambar sampai <b>1MB</b></li>
                          </ul>
                        </small>
                      </td>
                    </tr>
                    <?php if ($data['syslogo'] == '') { ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td>
                          <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </td>
                      </tr>
                    <?php }; ?>
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