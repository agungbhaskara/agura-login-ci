<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <div class="row my-4">
        <div class="col-lg-6">

            <!-- Page Heading -->
            <h6 class="text-sub text-uppercase font-weight-bold">overview</h6>
            <h1 class="h3 mb-3 text-white"><?= $title ?></h1>

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
                        <h5 class="card-title mb-0">user_role table</h5>
                        <!-- btn -->
                        <button type="button" data-toggle="modal" data-target="#newRole" class="btn btn-sm btn-custom">Create New</button>
                    </div>
                </div>

                <!-- table -->
                <table class="table table-sm table-nowrap table-hover table-card text-center mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Menu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($role as $data_role) : ?>
                            <tr>
                                <td scope="row"><?= $no++ ?></td>
                                <td><?= $data_role['role'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/roleaccess/' . $data_role['id']) ?>" class="badge badge-warning">access</a>
                                    <a href="#" class="badge badge-info">update</a>
                                    <a href="#" class="badge badge-danger">delete</a>
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

<!-- modal -->

<div class="modal fade" id="newRole" tabindex="-1" role="dialog" aria-labelledby="newRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-custom">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleLabel">Add a Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form -->

                <form class="form-custom" action="<?= base_url('admin/role') ?>" method="post">

                    <div class="form-group mb-0">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                    </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Menu</button>
                </form>

            </div>
        </div>
    </div>
</div>