<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/data/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/data/css/sb-admin-2.min.css" rel="stylesheet">
     <!--Personal CSS-->
     <link rel="stylesheet" href="<?= base_url('data/skin.css') ?>">

</head>

<body class="bg-gradient-white">

<?php $this->renderSection('konten') ?>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container">
        <div class="copyright text-center">
            <span>Copyright &copy; 2020 KOMPAS SELATAN All Right Reserved by 
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=mzaasya@gmail.com&su=Website_Request&body=Type_Your_Request" class="text-dark">mzaasya</a></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>/data/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>/data/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>/data/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>/data/js/sb-admin-2.min.js"></script>

</body>

</html>