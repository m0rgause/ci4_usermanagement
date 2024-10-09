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
            <li class="breadcrumb-item">Ubah</li>
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
                <form method="post" action="<?= site_url('setsystemprofile/' . $id) ?>" enctype="multipart/form-data">
                  <?= csrf_field() ?>
                  <a href="<?= site_url('setsystemprofile') ?>" class="btn btn-sm btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left"></i> Kembali </a>

                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <td width="20%">Dashboard Title</td>
                      <td>
                        <input class="form-control" type="text" name="systitle" value="<?= old('systitle') ? old('systitle') : $data['systitle'] ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('systitle') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>Institution Name</td>
                      <td>
                        <input class="form-control" type="text" name="sysname" value="<?= old('sysname') ? old('sysname') : $data['sysname'] ?>" required />
                        <small class="form-text text-danger"><?= $validation ? $validation->showError('sysname') : '' ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td>Penampungan</td>
                    </tr>
                    <tr>
                      <td>---- Display Mutasi</td>
                      <td>
                        <select class="select2 form-control mb-3 custom-select" name="penampungan_mt940_mutasi">
                          <?php foreach ($listMutasi as $key=>$value) { ?>
                            <option value="<?= $key; ?>" <?= $key == $data['penampungan_mt940_mutasi'] ? 'selected' : ''; ?>><?= $value; ?></option>
                          <?php }; ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>---- Flag MT940 (optional)</td>
                      <td>
                        <input class="form-control" type="text" name="penampungan_mt940_flag" value="<?= old('penampungan_mt940_flag') ? old('penampungan_mt940_flag') : $data['penampungan_mt940_flag'] ?>" />
                      </td>
                    </tr>

                    <tr>
                      <td>Utama</td>
                    </tr>
                    <tr>
                      <td>---- Display Mutasi</td>
                      <td>
                        <select class="select2 form-control mb-3 custom-select" name="utama_mt940_mutasi">
                          <?php foreach ($listMutasi as $key=>$value) { ?>
                            <option value="<?= $key; ?>" <?= $key == $data['utama_mt940_mutasi'] ? 'selected' : ''; ?>><?= $value; ?></option>
                          <?php }; ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>---- Flag MT940 (optional)</td>
                      <td>
                        <input class="form-control" type="text" name="utama_mt940_flag" value="<?= old('utama_mt940_flag') ? old('utama_mt940_flag') : $data['utama_mt940_flag'] ?>" />
                      </td>
                    </tr>
                    
                    <tr>
                      <td>Pengeluaran</td>
                    </tr>
                    <tr>
                      <td>---- Display Mutasi</td>
                      <td>
                        <select class="select2 form-control mb-3 custom-select" name="pengeluaran_mt940_mutasi">
                          <?php foreach ($listMutasi as $key=>$value) { ?>
                            <option value="<?= $key; ?>" <?= $key == $data['pengeluaran_mt940_mutasi'] ? 'selected' : ''; ?>><?= $value; ?></option>
                          <?php }; ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>---- Flag MT940 (optional)</td>
                      <td>
                        <input class="form-control" type="text" name="pengeluaran_mt940_flag" value="<?= old('pengeluaran_mt940_flag') ? old('pengeluaran_mt940_flag') : $data['pengeluaran_mt940_flag'] ?>" />
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