<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kegiatanku</h1>
</div>

<!-- Flash message success -->
<?php if(session()->getFlashData('pesan')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- Tambah data kegiatan -->
<a href="/kegiatanbaru" class="btn btn-success mb-4">Buat Kegiatan Baru</a>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
    <?php foreach($kegiatan as $kg): ?>
    <div class="col mb-4">
        <div class="card h-100 shadow rounded">
            <div class="card-header text-center"><h5><?= $kg['judul'] ?></h5></div>
            <?php if($kg['gambar'] !== NULL && $kg['gambar'] !== ''): ?>
            <img src="/img/kegiatan/<?= $kg['gambar'] ?>" class="card-img-top">
            <?php else: ?>
            <img src="/img/kegiatan/default.jpg" class="card-img-top">
            <?php endif; ?>
            <div class="card-body">
                <p class="card-text"><?= $kg['deskripsi'] ?></p>
            </div>
            <div class="card-footer text-center">
                <a href="/editkegiatan/<?= $kg['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="/hapuskegiatan/<?= $kg['id'] ?>" class="btn btn-sm btn-danger">Hapus</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?= $pager->links() ?>

<?php $this->endSection() ?>