<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="index.html">
        <div class="sidebar-brand-icon font-weight-light">
            <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text font-weight-bold mx-3">Agura</div>
    </a>

    <!-- QUERY MENU -->

    <?php
    $role_id = $this->session->userdata('role_id');

    // ? QUERY MENU gabungkan table user_menu dengan user_access_menu 
    // ? untuk menyesuaikan menu access sidebar berdasarkan user login

    $queryMenu = "SELECT `user_menu`.`id`, `menu`
            FROM `user_menu` JOIN `user_access_menu`
            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
            WHERE `user_access_menu`.`role_id`= $role_id 
            ORDER BY `user_access_menu`.`menu_id` ASC
            ";

    $menu = $this->db->query($queryMenu)->result_array();
    ?>


    <!-- LOOPING MENU -->
    <?php
    foreach ($menu as $sub_menu) :
        ?>

        <!-- Heading -->
        <div class="sidebar-heading font-weight-bold">
            <?= $sub_menu['menu'] ?>
        </div>

        <!-- SIAPKAN SUB-MENU SESUAI USER LOGIN -->
        <?php
            $menu_id = $sub_menu['id'];

            $querySubMenu = "SELECT *
            FROM `user_sub_menu`
            WHERE `menu_id`= $menu_id
            AND `user_sub_menu`.`is_active` = 1
            ";

            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

        <!-- sub-Menu -->
        <?php foreach ($subMenu as $sm) : ?>

            <li class="nav-item <?= ($sm['title'] == $title) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url($sm['url'])  ?>">
                    <i class="<?= $sm['icon'] ?>"></i>
                    <span><?= $sm['title'] ?></span></a>
            </li>

        <?php endforeach; ?>

        <!-- Divider -->
        <hr class="sidebar-divider my-3 mx-0">

    <?php
    endforeach;
    ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-block my-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Nav Item - Profile -->

    <div class="mt-auto">
        <a class="btn btn-primary shadow-sm btn-block mb-5" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt mr-2"></i>
            <span class="font-weight-bolder">Logout</span></a>
    </div>


</ul>
<!-- End of Sidebar -->