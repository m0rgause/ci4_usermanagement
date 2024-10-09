<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.php" class="logo">
            <span>
                <img src="<?= base_url('sysprofile/' . session()->get('syslogo')) ?>" alt=" logo" class="logo-sm d-none d-lg-inline" style="height:50px;">
            </span>

            <?php /*
            <span>
                <img src="<?= base_url('assets/logo/itb.png') ?>" alt=" logo-small" class="logo-sm" style="height:50px;">
            </span>
                */ ?>

        </a>
    </div>
    <!--end logo-->
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">
            <?php /*$notifData = getNotif() ?>
            <?php if (count($notifData) > 0) : ?>
                <li class="dropdown notification-list" style="height: max-content">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti-bell noti-icon"></i>
                        <span class="badge badge-danger badge-pill noti-icon-badge" style="padding:5px; margin: 8px 4px 0 0"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0" style="height: max-content">

                        <h6 class="dropdown-item-text font-15 m-0 py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                            Pending Approval <span class="badge badge-light badge-pill"></span>
                        </h6>
                        <div class="slimScrollDiv">
                            <div class=" notification-list">

                                <?php foreach ($notifData as $key => $notif) : ?>
                                    <!-- item-->
                                    <a href="<?= base_url('app' . $notif['tipe']); ?>" class="dropdown-item py-3">
                                        <p class="badge badge-pill badge-dark float-right text-muted p-2"><?= $notif['totalReqs']; ?></p>
                                        <div class="media">
                                            <div class="avatar-md bg-primary">
                                                <i class="la la-cart-arrow-down text-white"></i>
                                            </div>
                                            <div class="media-body align-self-center ml-2 text-truncate">
                                                <h6 class="my-0 font-weight-normal text-dark"><?= ucwords($notif['tipe']); ?></h6>

                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                <?php endforeach ?>


                            </div>
                        </div>
                    </div>
                </li>
            <?php endif */?>
            <li class="dropdown" style="margin:10px 10px 0 0;">
                <!-- <div style="font-size:11px; margin-left:-50px;">Supported by</div> -->
                <div><img src="<?= base_url('assets/logo/mandiri.png')?>" style="width:90px;margin-top:5px;" /></div>
            </li>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="dripicons-user"></i>
                    <span class="ml-1 nav-user-name"><?= session()->get('name'); ?> <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="setusermanagement/resetself/<?= session()->get('id'); ?>"><i class="dripicons-lock text-muted mr-2"></i> Reset Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= site_url('logout'); ?>"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                </div>
            </li>
        </ul>
        <!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="dripicons-menu nav-icon"></i>
                </button>
            </li>
            <li class="hide-phone app-search hidden-sm">
                <h4 class="mt-1"><?= session()->get('systitle'); ?> </h4>
            </li>
        </ul>
    </nav>
    <!-- end navbar-->
</div>