<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row mt-5 justify-content-center">

        <div class="col-xl-8">

            <div class="row align-items-center">

                <div class="col">
                    <!-- Page Heading -->
                    <h6 class="text-sub text-uppercase font-weight-bold">overview</h6>
                    <h1 class="h3 text-white font-weight-sebold"><?= $title ?></h1>
                </div>

            </div>

            <?= $this->session->flashdata('message') ?>

            <!-- tabs -->
            <div class="row align-items-center">
                <div class="col">
                    <ul class="nav header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('user/security') ?>">Security</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end tabs -->

            <!-- form -->
            <?= form_open_multipart('user/account') ?>

            <div class="row align-items-center my-4">

                <div class="col-12">

                    <div class="form-group row align-items-center mb-0 form-custom">

                        <!-- profile -->
                        <div class="col-auto">
                            <div class="avatar">
                                <img class="avatar-img rounded-circle" src="<?= base_url('assets/img/profile/' . $user['image']) ?>">
                            </div>
                        </div>

                        <div class="col">
                            <h6 class="text-white mb-2 font-weight-sebold">Your Picture</h6>
                            <small class="muted">PNG,JPG or GIF size upload no bigger than 2 mb .</small>
                        </div>

                        <div class="col-lg-auto mt-4 mt-lg-0">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                        <!-- end profile -->

                    </div>

                </div>

            </div>

            <div class="dropdown-divider divider-custom my-3"></div>

            <div class="row mt-5 form-custom">

                <div class="col-12">

                    <!-- form input -->

                    <div class="form-group row mb-4">
                        <label for="email" class="col-sm-2 col-form-label text-capitalize">email</label>
                        <div class="col-sm-10">
                            <input type="text" id="email" name="email" class="form-control no-drop" readonly value="<?= $user['email'] ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="name" class="col-sm-2 col-form-label text-capitalize">name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="<?= $user['name'] ?>">
                            <?= form_error('name', '<small class="form-text text-danger ml-0 mt-2">', '</small>') ?>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end mb-4">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary py-2 px-3">Save changes</button>
                        </div>
                    </div>

                    <!-- end form input -->

                </div>

            </div>

            </form>
            <!-- end form -->

        </div>

    </div>


</div>
<!-- /.container-fluid -->