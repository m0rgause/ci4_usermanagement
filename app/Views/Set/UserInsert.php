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
            <li class="breadcrumb-item active">User</li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>
        <h4 class="page-title">Tambah</h4>
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
                <form method="post" action="<?= site_url('setusermanagement/new') ?>">
                  <?= csrf_field() ?>
                  <a href="<?= site_url('setusermanagement') ?>" class="btn btn-sm btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left"></i> Kembali </a>

                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <td width="20%">Email</td>
                      <td>
                        <input class="form-control" type="email" name="email" value="<?= old('email') ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('email') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>Password</td>
                      <td>
                        <input class="form-control" type="password" name="password" value="<?= old('password') ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('password') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>Konfirmasi Password</td>
                      <td>
                        <input class="form-control" type="password" name="confirmNewPass" value="<?= old('confirmNewPass') ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('confirmNewPass') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>Role</td>
                      <td>
                        <select class="select2 form-control mb-3 custom-select" name="group" required>
                          <option value="">- Pilih Role - </option>
                          <?php foreach ($listGroup as $row) { ?>
                            <option value="<?= $row['id']; ?>" <?= old('group') == $row['id'] ? 'selected' : '' ?>><?= $row['nama']; ?></option>
                          <?php }; ?>
                        </select>
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('group') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td>
                        <input class="form-control" type="text" name="nama" value="<?= old('nama') ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('nama') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
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