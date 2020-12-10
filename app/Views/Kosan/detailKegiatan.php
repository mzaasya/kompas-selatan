<?php $this->extend('Layout/template') ?>

<?php $this->section('konten') ?>

<?php $this->ModelUser = new \App\Models\ModelUser(); ?>

<?php use CodeIgniter\I18n\Time; ?>

<div class="p-5"></div>

<div class="container">
    <h2 class="text-center font-comfort"><?= $kg['judul'] ?></h2>

    <br>

    <!-- --------------- Image List ------------------- -->
    <div class="row row-cols-2 row-cols-md-4 dt-kg align-items-center justify-content-center">
        <!-- 1st image -->
        <div class="col">
            <div class="card h-100 mb-4 border-light" data-toggle="modal" data-target="#md-kg-1">
                <img src="/img/kegiatan/<?= $kg['gambar'] !== NULL && $kg['gambar'] !== '' ? $kg["gambar"] : 'default.jpg' ?>" class="card-img-top shadow">
            </div>
        </div>
        <!-- 2nd image -->
        <?php if($kg['gambar1'] !== NULL && $kg['gambar1'] !== ''): ?>
        <div class="col">
            <div class="card h-100 mb-4 border-light" data-toggle="modal" data-target="#md-kg-2">
                <img src="/img/kegiatan/<?= $kg['gambar1'] ?>" class="card-img-top shadow">
            </div>
        </div>
        <?php endif; ?>
        <!-- 3rd image -->
        <?php if($kg['gambar2'] !== NULL && $kg['gambar2'] !== ''): ?>
        <div class="col">
            <div class="card h-100 mb-4 border-light" data-toggle="modal" data-target="#md-kg-3">
                <img src="/img/kegiatan/<?= $kg['gambar2'] ?>" class="card-img-top shadow">
            </div>
        </div>
        <?php endif; ?>
        <!-- 4th image -->
        <?php if($kg['gambar3'] !== NULL && $kg['gambar3'] !== ''): ?>
        <div class="col">
            <div class="card h-100 mb-4 border-light" data-toggle="modal" data-target="#md-kg-4">
                <img src="/img/kegiatan/<?= $kg['gambar3'] ?>" class="card-img-top shadow">
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- --------------- detail card ------------------- -->
    <div class="card shadow rounded-lg border-light">
        <h3 class="text-center text-dark font-nunito pt-4">Detail Kegiatan</h3>
        <hr>
        <div class="card-body font-nunito text-dark">
            <div class="row row-cols-1 row-cols-md-2">
                <!-- 1st column -->
                <div class="col">
                    <div class="row">
                        <div class="col-4"><b>Judul</b></div>
                        <div class="col-8"><?= $kg['judul'] ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><b>Deskripsi</b></div>
                        <div class="col-8"><?= $kg['deskripsi'] ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><b>Tujuan</b></div>
                        <div class="col-8"><?= $kg['tujuan'] ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><b>Kumpul</b></div>
                        <div class="col-8"><?= $kg['titik_kumpul'] ?></div>
                    </div>
                    <hr>
                </div>
                <!-- 2nd column -->
                <div class="col">
                    <div class="row">
                        <div class="col-4"><b>Tanggal</b></div>
                        <?php $tanggal = Time::parse($kg['tanggal'], 'Asia/Jakarta', 'id_ID') ?>
                        <div class="col-8"><?= $tanggal->toLocalizedString('dd MMMM yyyy') ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><b>Jam</b></div>
                        <?php $jam = Time::parse($kg['jam'], 'Asia/Jakarta', 'id_ID') ?>
                        <div class="col-8"><?= $jam->toLocalizedString('H:mm').' WIB' ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><b>Biaya</b></div>
                        <div class="col-8">Rp <?= number_format($kg['biaya'],0,'.','.') ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><b>Author</b></div>
                        <?php $sr = $this->ModelUser->find($kg['created_by']) ?>
                        <div class="col-8"><?= $sr['name'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- --------------- Modal Image ------------------- -->
<!-- Modal 1 -->
<div class="modal fade" id="md-kg-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered text-center">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="far fa-times-circle p-2"></i>
        </button>
        <img src="/img/kegiatan/<?= $kg['gambar'] !== NULL && $kg['gambar'] !== '' ? $kg["gambar"] : 'default.jpg' ?>" class="img-fluid">
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="md-kg-2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered text-center">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="far fa-times-circle p-2"></i>
        </button>
        <img src="/img/kegiatan/<?= $kg['gambar1'] ?>" class="img-fluid">
    </div>
  </div>
</div>

<!-- Modal 3 -->
<div class="modal fade" id="md-kg-3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered text-center">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="far fa-times-circle p-2"></i>
        </button>
        <img src="/img/kegiatan/<?= $kg['gambar2'] ?>" class="img-fluid">
    </div>
  </div>
</div>

<!-- Modal 4 -->
<div class="modal fade" id="md-kg-4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered text-center">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="far fa-times-circle p-2"></i>
        </button>
        <img src="/img/kegiatan/<?= $kg['gambar3'] ?>" class="img-fluid">
    </div>
  </div>
</div>

<?php $this->endSection() ?>