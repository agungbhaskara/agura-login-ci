<div class="container h-100">

    <!-- Outer Row -->
    <div class="row justify-content-center h-100 align-items-center">

        <div class="col-lg-6 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0" style="height:400px;">
                    <!-- Nested Row within Card Body -->
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-lg-11">
                            <div class="px-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forgot Your Password?</h1>
                                </div>

                                <!-- flash message -->
                                <?= $this->session->flashdata('message') ?>

                                <form class="user" method="POST" action="<?= base_url('auth/forgotpassword') ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." autocomplete="off" value="<?= set_value('email') ?>">
                                        <?= form_error('email', '<small class="form-text text-danger ml-3">', '</small>') ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset password
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth') ?>">Login</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/registration') ?>">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>