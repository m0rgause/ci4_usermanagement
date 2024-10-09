<?= $this->extend('Lay/template-index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="float-right">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Parameter</a></li>
            <li class="breadcrumb-item active">System Profile</li>
          </ol>
        </div>
        <h4 class="page-title">System Profile</h4>
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


                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Dashboard Title</th>
                      <th>Institution Title</th>
                      <th>Logo</th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>
                        <?= $data['systitle']; ?>
                      </td>
                      <td>
                        <?= $data['sysname']; ?>
                      </td>
                      <td><img src="<?= base_url('sysprofile/' . $data['syslogo']) ?>" style="width:100px;"></td>
                      <td nowrap>
                        <a href="<?= site_url('setsystemprofile/' . $data['id']) ?>" class=" btn btn-success" style="padding: 2px 6px; margin: 0 3px"><i class=" fa fa-edit"></i></a>
                        <a href="<?= site_url('setsystemprofile/upload/' . $data['id']) ?>" class=" btn btn-primary" style="padding: 2px 6px; margin: 0 3px"><i class=" fa fa-upload"></i></a>
                      </td>
                    </tr>
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