<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Personal CSS-->
    <link rel="stylesheet" href="<?= base_url() ?>/data/skin.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Font Awesome Kit -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <title><?= $title ?></title>
  </head>
  <body>

    <header>
      <div class="navbar navbar-expand-lg navbar-light bg-white fixed-top nav-con">
          <!-- navbar brand -->
          <a href="/" class="navbar-brand font-balsamiq">
            <img src="<?= base_url('img/kosan.png') ?>" width="50" height="50" class="d-none d-md-inline-block align-middle" loading="lazy">
            KOMPAS SELATAN
          </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navTog" aria-controls="navTog" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- navbar collapse items -->
        <div class="collapse navbar-collapse" id="navTog">
          <!-- navbar menu -->
          <ul class="navbar-nav mx-auto mt-2 mt-lg-0 font-comfort font-300">
            <li class="nav-item">
              <a href="/" class="nav-link text-dark"><b>Beranda</b></a>
            </li>
            <div class="d-none d-lg-block divider"></div>
            <li class="nav-item">
              <a href="/kegiatan" class="nav-link text-dark"><b>Kegiatan</b></a>
            </li>
            <div class="d-none d-lg-block divider"></div>
            <li class="nav-item">
              <a href="/ekstra" class="nav-link text-dark"><b>Ekstra</b></a>
            </li>
            <div class="d-none d-lg-block divider"></div>
            <li class="nav-item">
              <a href="/tentangkami" class="nav-link text-dark"><b>Tentang Kami</b></a>
            </li>
          </ul>

          <!-- navbar button -->
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <?php if(session()->is_loggedin == true): ?>
            <li class="nav-item m-1">
              <a href="/profil" class="btn btn-outline-light text-white cc-main"><i class="fas fa-user-cog"></i> Pengaturan</a>
            </li>
            <li class="nav-item m-1">
              <a href="#" class="btn btn-outline-light text-white cc-main" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt"></i> Keluar</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a href="/login" class="btn btn-outline-light text-white cc-main"><i class="fas fa-sign-in-alt"></i> Masuk</a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </header>

    <?php $this->renderSection('konten') ?>

    <div class="container p-3 text-center">
      <footer>
        <small class="text-muted">Copyright &copy; 2020 KOMPAS SELATAN All Right Reserved by 
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=mzaasya@gmail.com&su=Website_Request&body=Type_Your_Request" class="text-dark">mzaasya</a></small>
      </footer>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kok keluar sih? :(</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan <b>Logout</b> ya kalau Sudah yakin mau keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/data/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/data/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Personal Javascript -->
    <script src="<?= base_url() ?>/data/brain.js"></script>
  </body>
</html>