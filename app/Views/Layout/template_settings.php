<?php 
    use CodeIgniter\I18n\Time;
    $this->ModelUser = new \App\Models\ModelUser();
    $this->ModelPesan = new \App\Models\ModelPesan();
    $this->ModelPengumuman = new \App\Models\ModelPengumuman();
?>

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

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/data/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- personal css -->
    <link href="<?= base_url() ?>/data/setting.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion cc-static" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="far fa-compass"></i>
                </div>
                <div class="sidebar-brand-text mx-3">KOSAN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/profil">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Konten -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Konten</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Konten:</h6>
                        <a class="collapse-item" href="/kegiatanku">Kegiatan</a>
                        <a class="collapse-item" href="/beritaku">Berita</a>
                        <a class="collapse-item" href="/ekstraku">Ekstra</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Anggota -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Anggota</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Anggota:</h6>
                        <a class="collapse-item" href="/myprofile">Profilku</a>
                        <a class="collapse-item" href="/ubahpassword">Ubah Password</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pesan -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Pesan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Pesan:</h6>
                        <a class="collapse-item" href="/kirimpesan">Kirim Pesan</a>
                        <a class="collapse-item" href="/pesanmasuk">Pesan Masuk</a>
                        <a class="collapse-item" href="/pesankeluar">Pesan Keluar</a>
                    </div>
                </div>
            </li>

            <?php if(session()->email === 'kompas.selatan.id@gmail.com'): ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Developer
            </div>

            <!-- Nav Item - pengumuman -->
            <li class="nav-item">
                <a class="nav-link" href="/pengumuman">
                    <i class="fas fa-fw fa-exclamation-triangle"></i>
                    <span>Pengumuman</span>
                </a>
            </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <?php $pgm = $this->ModelPengumuman->where('created_at > now() - interval 7 DAY')->orderBy('created_at', 'DESC')->findAll() ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><?= count($pgm) ?></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header" style="background-color:#835331;border:1px solid #835331;">
                                    Pengumuman
                                </h6>
                                <?php foreach($pgm as $pg): ?>
                                <a class="dropdown-item d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-info text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <?php $pgdibuat = Time::parse($pg['created_at'], 'Asia/Jakarta') ?>
                                        <?php $pgnow = Time::now('Asia/Jakarta', 'id_ID') ?>
                                        <?php $pgexp = $pgdibuat->difference($pgnow) ?>
                                        <div class="small text-gray-500"><?= $pgdibuat->toLocalizedString('d MMMM, yyyy') ?></div>
                                        <?= $pg['pesan'] ?>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                                <small class="dropdown-item text-center small text-gray-500">Pengumuman akan hilang setelah 7 hari</small>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <?php $query = ['created_for' => session()->id, 'status' => 0] ?>
                        <?php $messages = $this->ModelPesan->where($query)->orderBy('created_at', 'DESC')->findAll() ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?= count($messages) ?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header" style="background-color:#835331;border:1px solid #835331;">
                                    Pesan Masuk
                                </h6>
                                <?php foreach($messages as $pesan): ?>
                                    <?php $userPesan = $this->ModelUser->where('id', $pesan['created_by'])->first() ?>
                                    <?php $dibuat = Time::parse($pesan['created_at'], 'Asia/Jakarta') ?>
                                <a class="dropdown-item d-flex align-items-center" href="/detailpesan/<?= $pesan['id'] ?>">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?= base_url() ?>/img/user/<?= ($userPesan['image'] !== NULL && $userPesan['image'] !== '') ? $userPesan['image'] : 'default.png' ?>">
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><?= $pesan['pesan'] ?></div>
                                        <div class="small text-gray-500"><?= $userPesan['name'] ?> · <?= $dibuat->humanize() ?></div>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                                <a class="dropdown-item text-center small text-gray-500" href="/pesanmasuk">Lihat Pesan Lainnya</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <?php $user = $this->ModelUser->find(session()->id) ?>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name'] ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url() ?>/img/user/<?= ($user['image'] !== NULL && $user['image'] !== '') ? $user['image'] : 'default.png' ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/myprofile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profilku
                                </a>
                                <a class="dropdown-item" href="/ubahpassword">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- render main content -->
                <?php $this->renderSection('konten') ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2020 KOMPAS SELATAN All Right Reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin mau logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol "Logout" dibawah jika sudah yakin.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/data/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/data/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/data/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/data/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url() ?>/data/brain.js"></script>

</body>

</html>