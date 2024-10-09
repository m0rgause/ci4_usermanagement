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
            <li class="breadcrumb-item"><a>User Access</a></li>
            <li class="breadcrumb-item active">Role</li>
            <li class="breadcrumb-item active">Ubah</li>
          </ol>
        </div>
        <h4 class="page-title">Ubah</h4>
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
                <form method="post" action="<?= site_url('setgroup/' . $data['id']) ?>">
                  <?= csrf_field() ?>
                  <a href="<?= site_url('setgroup') ?>" class="btn btn-sm btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left"></i> Kembali </a>

                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <td width="20%">Nama</td>
                      <td>
                        <input class="form-control" type="text" name="nama" value="<?= old('nama') ? old('nama') : $data['nama'] ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('nama') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>Deskripsi</td>
                      <td>
                        <input class="form-control" type="text" name="deskripsi" value="<?= old('deskripsi') ? old('deskripsi') : $data['deskripsi'] ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('deskripsi') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>Landing Page</td>
                      <td>
                        <input class="form-control" type="text" name="landing_page" value="<?= old('landing_page') ? old('landing_page') : $data['landing_page'] ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('landing_page') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        <a href="<?= site_url('setgroup/' . $data['id'] . '/delete') ?>" class="btn btn-outline-info" onclick="return confirm('Data akan dihapus!')"><i class="fa fa-trash"></i> Hapus </a>
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