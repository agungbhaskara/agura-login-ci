<div class="container h-100">

    <!-- Outer Row -->
    <div class="row justify-content-center h-100 align-items-center">

        <div class="col-lg-6 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0" style="height:500px;">
                    <!-- Nested Row within Card Body -->
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-lg-11">
                            <div class="px-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Reset Your Password for!</h1>
                                    <h1 class="h6 text-gray-900 font-weight-bold mb-4"><?= $this->session->userdata('reset_user') ?></h1>
                                </div>

                                <!-- flash message -->
                                <?= $this->session->flashdata('message') ?>

                                <form class="user" method="POST" action="<?= base_url('auth/changePassword') ?>">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="new_password" name="new_password" placeholder="New Password" autocomplete="off" value="<?= set_value('password') ?>">
                                        <?= form_error('new_password', '<small class="form-text text-danger ml-3">', '</small>') ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="repeat_password" name="repeat_password" placeholder="Repeat Password">
                                        <?= form_error('repeat_password', '<small class="form-text text-danger ml-3">', '</small>') ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>