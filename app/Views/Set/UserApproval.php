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
            <li class="breadcrumb-item active">Approval</li>
          </ol>
        </div>
        <h4 class="page-title">Approval</h4>
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
                <a href="<?= site_url('setusermanagement') ?>" class="btn btn-sm btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left"></i> Kembali </a>
                <form method="post" action="<?= site_url('setusermanagement/apv/' . $data['id']); ?>">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?= csrf_field() ?>
                    <tr>
                      <td>Nama</td>
                      <td><?= $data['nama']; ?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td><?= $data['email']; ?></td>
                    </tr>
                    <tr>
                      <td>Target Approval</td>
                      <td>
                        <select style="width:300px" multiple="multiple" name="user_id[]" id="multiselect">
                          <?php foreach ($users as $user) { ?>
                            <option value="<?= $user['id'] ?>" <?= in_array($user['id'], $slcuser) ? 'selected' : '' ?>><?= $user['nama'] ?> (<?= $user['group_nama'] ?>)</option>
                          <?php }; ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
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