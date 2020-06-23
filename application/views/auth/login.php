<div class="container h-100">

    <!-- Outer Row -->
    <div class="row justify-content-center h-100 align-items-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0" style="height:500px;">
                    <!-- Nested Row within Card Body -->
                    <div class="row h-100 align-items-center">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="height:500px;"></div>
                        <div class="col-lg-6">
                            <div class="px-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Page!</h1>
                                </div>

                                <!-- flash message -->
                                <?= $this->session->flashdata('message') ?>

                                <form class="user" method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." autocomplete="off" value="<?= set_value('email') ?>">
                                        <?= form_error('email', '<small class="form-text text-danger ml-3">', '</small>') ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="form-text text-danger ml-3">', '</small>') ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/forgotpassword') ?>">Forgot Password?</a>
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