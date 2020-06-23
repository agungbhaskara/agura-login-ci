<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <div class="row my-4">
        <div class="col-lg-6">

            <!-- Page Heading -->
            <h6 class="text-sub text-uppercase font-weight-bold">overview</h6>
            <h1 class="h3 mb-3 text-white"><?= $title . ' : ' . $role['role'] ?></h1>

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">
                    ', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

        </div>
    </div>

    <!-- menu table -->
    <div class="row">

        <div class="col-lg-6">

            <div class="card card-custom">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">user_access table</h5>
                    </div>
                </div>

                <!-- table -->
                <table class="table table-sm table-nowrap table-hover table-card text-center mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Menu</th>
                            <th>Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($menu as $data_menu) : ?>
                            <tr>
                                <td scope="row"><?= $no++ ?></td>
                                <td><?= $data_menu['menu'] ?></td>
                                <td>
                                    <!-- function centang di helper -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $data_menu['id']); ?> data-role="<?= $role['id'] ?>" data-role="<?= $role['id'] ?>" data-menu="<?= $data_menu['id'] ?>">
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>


        </div>

    </div>

</div>
<!-- /.container-fluid -->