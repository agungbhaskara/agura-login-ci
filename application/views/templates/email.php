<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Agung Rageshwara">


    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/') ?>css/blocked.css" rel="stylesheet">


</head>

<body id="page-top" class="d-flex align-items-center">

    <!-- Begin Page Content -->
    <div class="container-fluid bg-custom">

        <!-- 404 Error Text -->
        <div class="text-center">
            <h6 class="text-uppercase small mb-4 font-weight-bold text-error text-muted"><?= $title ?></h6>
            <h2 class="text-white font-weight-bold mb-3">Hi, <?= $email ?></h2>
            <p class="text-muted mb-5"><?= $message ?></p>
            <a href="<?= base_url('auth/forgotpassword?email=' . $email . '&token=' . $token) ?>" class="btn btn-primary py-3 px-5 font-weight-sebold">Reset Password</a>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

</body>

</html>