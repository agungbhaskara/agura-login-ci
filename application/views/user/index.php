<!-- Begin Page Content -->

<!-- cover image -->
<div class="jumbotron jumbotron-fluid bg-cover-image p-0" style="height: 250px; position: relative;">
    <div class="overflow"></div>
</div>
<!-- end cover image -->

<!-- profile -->
<div class="container-fluid header-section">

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message') ?>"></div>

    <div class="header-cover">

        <div class="row align-items-end">

            <!-- avatar -->
            <div class="col-auto">
                <div class="avatar avatar-xxl avatar-header">
                    <img src="<?= base_url('assets/img/profile/' . $user['image']) ?>" alt="profile" class="avatar-img rounded-circle avatar-border">
                </div>
            </div>
            <!-- endavatar -->

            <!-- name & role -->
            <div class="col">
                <h6 class="header-pretiele font-weight-bolder">member since <?= date('d M Y', $user['date_created']) ?></h6>
                <h1 class="h4 text-white font-weight-bold"><?= $user['name'] ?></h1>
            </div>
        </div>

    </div>
    <!-- endprofile -->

    <!-- tabs -->
    <div class="row align-items-center">
        <div class="col">
            <ul class="nav header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Groups</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Project</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Files</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end tabs -->

</div>
<!-- /.container-fluid -->

<!-- end profile -->

<div class="container-fluid content">
    <div class="row">
        <div class="col-xl-8">

            <!-- post card -->
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row align-items-center mb-4">

                        <!-- profile -->

                        <!-- picture -->
                        <div class="col-auto">
                            <a href="#" class="avatar">
                                <img src="<?= base_url('assets/img/profile/' . $user['image']) ?>" alt="profile" class="avatar-img rounded-circle">
                            </a>
                        </div>

                        <!-- name -->
                        <div class="col ml-n2">
                            <h4 class="h6 text-white"><?= $user['name'] ?></h4>
                            <p class="small card-text text-muted font-weight-bolder">
                                <i class="far fa-clock"></i>
                                <?= date('h:i:a', $user['date_created']) ?></p>
                        </div>

                        <!-- action -->
                        <div class="col-auto">
                            <div class="dropdown">
                                <a class="dropdown-ellipses dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- end profile -->

                    <div class="row">
                        <div class="col">
                            <p class="text-post">Hello My Name is Agung Rageshwara. You can call me bhaskara, i'm Web Programmer as Backend Development for now and i'm UI UX designer too, i'm a junior programmer so nice to meet you everyone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end post card -->

        </div>
    </div>
</div>