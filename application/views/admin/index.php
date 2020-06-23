<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row mt-4">
        <div class="col-lg-6">

            <!-- Page Heading -->
            <h6 class="text-sub text-uppercase font-weight-bold">overview</h6>
            <h1 class="h3 mb-3 text-white">Dashboard</h1>
            <p class="text-welcome small text-white text-uppercase font-weight-sebold">Welcome <?= ($user['name']) ?></p>

        </div>

    </div>

    <div class="dropdown-divider divider-custom"></div>

</div>
<!-- /.container-fluid -->

<!-- content -->
<div class="container-fluid">

    <div class="row">

        <!-- users -->
        <div class="col-lg-4">
            <div class="card card-custom">
                <div class="card-body">

                    <!-- users -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-block">
                            <div class="h6 card-title card-title-dashboard text-muted text-uppercase font-weight-bold mb-2">user active</div>
                            <h4 class="text-white font-weight-bold"><?= $num_users ?> User</h4>
                        </div>
                        <i class="fas fa-fw fa-user mr-3" style="font-size:24px;"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- menu -->
        <div class="col-lg-4">
            <div class="card card-custom">
                <div class="card-body">

                    <!-- menu -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-block">
                            <div class="h6 card-title card-title-dashboard text-muted text-uppercase font-weight-bold mb-2">user menu</div>
                            <h4 class="text-white font-weight-bold"><?= $num_menu ?> Menu</h4>
                        </div>
                        <i class="fas fa-fw fa-folder mr-3" style="font-size:24px;"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- user_sub_menu -->
        <div class="col-lg-4">
            <div class="card card-custom">
                <div class="card-body">

                    <!-- user_sub_menu -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-block">
                            <div class="h6 card-title card-title-dashboard text-muted text-uppercase font-weight-bold mb-2">user sub menu</div>
                            <h4 class="text-white font-weight-bold"><?= $num_sub_menu ?> Menu</h4>
                        </div>
                        <i class="fas fa-fw fa-folder-open mr-3" style="font-size:24px;"></i>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>