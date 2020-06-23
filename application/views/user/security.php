<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <div class="row mt-5 justify-content-center">

        <div class="col-xl-8">

            <div class="row align-items-center">

                <div class="col">
                    <!-- Page Heading -->
                    <h6 class="text-sub text-uppercase font-weight-bold">overview</h6>
                    <h1 class="h3 text-white font-weight-sebold"><?= $title ?></h1>
                </div>

            </div>

            <!-- tabs -->
            <div class="row align-items-center">
                <div class="col">
                    <ul class="nav header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('user/account') ?>">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('user/security') ?>">Security</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end tabs -->

            <div class="row mt-5 mb-4">

                <div class="col-lg-8">
                    <h1 class="h4 text-white font-weight-sebold mb-3">Change Your Password</h1>
                    <p class="text-muted">We will email you a confirmation when changing your password, so please expect that email after submitting.
                    </p>
                </div>

            </div>

            <?= $this->session->flashdata('message') ?>


            <div class="row align-items-center">

                <!-- form section -->
                <div class="col-lg-6 order-lg-1 order-2">

                    <!-- form -->
                    <form action="<?= base_url('user/security') ?>" method="post" class="form-custom">

                        <div class="form-group mb-4">
                            <label for="currentpassword">Current Password</label>
                            <input type="password" class="form-control" id="currentpassword" name="currentpassword">
                            <small class="form-text text-danger"><?= form_error('currentpassword') ?></small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="newpassword">New Password</label>
                            <input type="password" class="form-control" id="newpassword" name="newpassword">
                            <small class="form-text text-danger"><?= form_error('newpassword') ?></small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="repeatpassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="repeatpassword" name="repeatpassword">
                            <small class="form-text text-danger"><?= form_error('repeatpassword') ?></small>
                        </div>

                        <div class="form-group mb-4">
                            <button class="btn btn-primary py-2 px-4 btn-block font-weight-sebold">Change password</button>
                        </div>

                    </form>
                    <!-- end form -->

                </div>

                <!-- require password -->
                <div class="col-lg-6 order-lg-2 order-1">

                    <div class="card card-custom ml-lg-4 ml-0">
                        <div class="card-body">
                            <h4 class="card-title">Password requirements</h4>
                            <p class="small text-muted">
                                To create a new password, you have to meet all of the following requirements:
                            </p>
                            <ul class="small text-muted pl-md-4 mb-0 font-weight-sebold">
                                <li>Minimum 8 character</li>
                                <li>At least one special character</li>
                                <li>At least one number</li>
                                <li>can't be the same as a previous password</li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


</div>
<!-- /.container-fluid -->