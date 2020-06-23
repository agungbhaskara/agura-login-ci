<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand bg-custom navbar-light topbar static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-size">
                            <img class="avatar-img rounded-circle" src="<?= base_url('assets/img/profile/' . $user['image']) ?>">
                            <div class="avatar-online"></div>
                        </div>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in bg-custom" style="top:75%" aria-labelledby="userDropdown">
                        <a class="dropdown-item text-white-50 pt-2 pb-3" href="<?= base_url('user') ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                            My Profile
                        </a>
                        <a class="dropdown-item text-white-50 mb-3" href="<?= base_url('user/account') ?>">
                            <i class="fas fa-cog fa-sm fa-fw mr-2"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider bg-custom"></div>
                        <a class="dropdown-item text-white-50 py-2" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->