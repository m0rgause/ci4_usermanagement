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
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div>
        <h4 class="page-title">User</h4>
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

                <a href="<?= site_url('setusermanagement/new'); ?>" class="btn btn-sm btn-primary float-left"
                  style="margin-bottom: 20px;"><i class="fa fa-plus"></i> Tambah</a>


                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Last Login</th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>

                  <tbody>

                    <?php foreach ($userList as $row) { ?>

                    <tr>
                      <td><?= $row['nama']; ?></td>
                      <td><?= $row['email']; ?></td>
                      <td><?= $row['group_nama']; ?></td>
                      <td><?= $row['status'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                      <td><?= $row['last_login']; ?></td>
                      <td nowrap>
                        <a href="<?= site_url('setusermanagement/' . $row['id']) ?>" class=" btn btn-success"
                          style="padding: 2px 6px; margin: 0 3px" data-toggle="tooltip" data-placement="top"
                          title="Edit"><i class=" fa fa-edit"></i></a>
                        <a href="<?= site_url('setusermanagement/reset/' . $row['id']) ?>" class=" btn btn-primary"
                          style="padding: 2px 6px; margin: 0 3px" data-toggle="tooltip" data-placement="top"
                          title="Akses"><i class=" fa fa-key"></i></a>
                        <a href=" <?= site_url('setusermanagement/apv/' . $row['id']) ?>" class=" btn btn-warning"
                          style="padding: 2px 6px; margin: 0 3px" data-toggle="tooltip" data-placement="top"
                          title="Approval"><i class=" fa fa-user"></i></a>
                      </td>
                    </tr>

                    <?php }; ?>

                  </tbody>
                </table>
                <?= $pagination->links() ?>
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