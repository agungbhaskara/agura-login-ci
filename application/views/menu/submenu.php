<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message') ?>"></div>

    <div class="row my-4">
        <div class="col-lg-6">

            <!-- Page Heading -->
            <h6 class="text-sub text-uppercase font-weight-bold">overview</h6>
            <h1 class="h3 mb-3 text-white"><?= $title ?></h1>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- menu table -->
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-custom">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">
                            <h6 class="card-title mb-0 mr-3">user_sub_menu table</h6>
                            <span class="badge badge-soft-secondary"><?= $menu_row ?></span>
                        </div>

                        <!-- btn -->
                        <button type="button" data-toggle="modal" data-target="#newSubMenu" class="btn btn-sm btn-custom">Create New</button>
                    </div>
                </div>

                <!-- table -->
                <table class="table table-responsive-lg table-sm table-nowrap table-hover table-card mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Title</th>
                            <th>Menu Category</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sub_menu as $data_menu) : ?>
                            <tr>
                                <td scope="row"><?= $no++ ?></td>
                                <td><?= $data_menu['title'] ?></td>
                                <td><?= $data_menu['menu'] ?></td>
                                <td><?= $data_menu['url'] ?></td>
                                <td><i class="<?= $data_menu['icon'] ?>"></i> <?= $data_menu['icon'] ?></td>
                                <?php if ($data_menu['is_active'] == 1) : ?>
                                    <td>
                                        <span class="badge badge-soft-success">active</span>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <span class="badge badge-soft-muted">deactive</span>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <a href="#" class="badge badge-info">update</a>
                                    <a href="<?= base_url('menu/deleteSubMenu/' . $data_menu['id']) ?>" class="badge badge-danger btn-delete">delete</a>
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

<div class=" modal fade" id="newSubMenu" tabindex="-1" role="dialog" aria-labelledby="newSubMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-custom">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuLabel">Add a SubMenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form -->

                <form class="form-custom" action="<?= base_url('menu/submenu') ?>" method="post">

                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option disabled selected>-- Select Menu --</option>
                            <?php foreach ($menu as $menu_select) : ?>
                                <option value="<?= $menu_select['id'] ?>"><?= $menu_select['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="SubMenu Url" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="SubMenu Icon" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add SubMenu</button>
                </form>

            </div>
        </div>
    </div>
</div>