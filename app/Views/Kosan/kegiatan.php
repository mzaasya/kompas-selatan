<?php $this->extend('Layout/template') ?>

<?php $this->section('konten') ?>

<?php $this->ModelUser = new \App\Models\ModelUser() ?>

<?php use CodeIgniter\I18n\Time; ?>

<div class="p-5"></div>

<div class="container p-5">
    <h3 class="text-center font-comfort">Daftar Kegiatan 
        <?php if($av_event): ?>
        <small><sup class="badge badge-success"><?= count($av_event) ?></sup></small>
        <?php else: ?>
        <small><sup class="badge badge-danger">0</sup></small>
        <?php endif; ?>
    </h3>

    <!-- keterangan kegiatan yang ada atau tidak ada -->
    <?php if($av_event): ?>
    <small class="d-block text-center text-success">Wah ada <?= count($av_event) ?> kegiatan yang bisa kamu ikuti nih, gabung yuk!</small>
    <?php else: ?>
    <small class="d-block text-center text-danger">Yah... belum ada kegiatan yang bisa kamu ikuti, buat kegiatan baru yuk!</small>
    <?php endif; ?>
    <div class="mb-5"></div>
    
    <!-- sort by -->
    <div class="mb-4 text-center font-balsamiq">
        <a class="btn btn-sm btn-primary mb-2" href="/kegiatan">Terbaru</a>
        <a class="btn btn-sm btn-secondary mb-2" href="/kegiatan/lama">Terlama</a>
        <a class="btn btn-sm btn-success mb-2" href="/kegiatan/aktif">Masih Aktif</a>
        <a class="btn btn-sm btn-danger mb-2" href="/kegiatan/pasif">Sudah Lewat</a>
    </div>

    <?php if(count($kegiatan) == 0 && count($kegiatan) == NULL): ?>
        <h1 class="text-center py-5">Oops... Belum Ada datanya nih</h1>
    <?php else: ?>
    <!-- card -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 all-kg">
        <?php foreach($kegiatan as $kg): ?>
        <div class="col mb-4">
            <a href="/kegiatan/<?= $kg['id'] ?>">
                <div class="card h-100 shadow border-light">
                    <div class="card-header"><h5 class="text-dark text-center"><?= $kg['judul'] ?></h5></div>
                    <?php if($kg['gambar'] !== NULL && $kg['gambar'] !== ''): ?>
                    <img src="/img/kegiatan/<?= $kg['gambar'] ?>" class="card-img-top">
                    <?php else: ?>
                    <img src="/img/kegiatan/default.jpg" class="card-img-top">
                    <?php endif; ?>
                    <div class="card-body">
                        <p class="card-text text-dark"><?= $kg['deskripsi'] ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <?php if($kg['tanggal'] > $today): ?>
                            <?php $tanggal = Time::parse($kg['tanggal'], 'Asia/Jakarta', 'id_ID') ?>
                            <small class="badge badge-pill badge-success"><?= $tanggal->toLocalizedString('d MMMM yyyy') ?></small>
                        <?php else: ?>
                            <small class="badge badge-pill badge-danger">sudah lewat</small>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?= $pager->links() ?>
</div>

<?php $this->endSection() ?>