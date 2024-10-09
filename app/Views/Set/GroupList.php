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
          </ol>
        </div>
        <h4 class="page-title">Role</h4>
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

                <a href="<?= site_url('setgroup/new') ?>" class="btn btn-sm btn-primary float-left" style="margin-bottom: 20px;"><i class="fa fa-plus"></i> Tambah</a>


                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Landing Page</th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $num = 1; ?>
                    <?php foreach ($groupList as $list) { ?>
                      <tr>
                        <td><?= $num; ?></td>
                        <td><?= $list['nama']; ?></td>
                        <td><?= $list['landing_page']; ?></td>
                        <td nowrap>
                          <a href="<?= site_url('setgroup/' . $list['id']); ?>" class=" btn btn-success" style="padding: 2px 6px; margin: 0 3px"><i class=" fa fa-edit"></i></a>
                          <a href="<?= site_url('setgroup/access/' . $list['id']); ?>" class=" btn btn-primary" style="padding: 2px 6px; margin: 0 3px"><i class=" fa fa-key"></i></a>
                        </td>
                      </tr>
                      <?php $num++; ?>
                    <?php } ?>
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