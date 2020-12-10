<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Buat Kegiatan Baru</h1>
</div>

<!-- Flash message failed -->
<?php if(session()->getFlashData('pesan')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- main -->
<form action="<?= base_url('Kegiatan/kegiatanbaruAct') ?>" method="post" enctype="multipart/form-data">
    <!-- Judul -->
    <div class="form-group">
        <input type="text" class="form-control 
        <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" 
        name="judul" placeholder="Judul Kegiatan" value="<?= old('judul') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('judul') ?>
        </div>
    </div>
    <!-- deskripsi -->
    <div class="form-group">
        <textarea name="deskripsi" id="deskripsi" class="form-control 
        <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ?>" 
        rows="5" placeholder="Deskripsi"><?= old('deskripsi') ?></textarea>
        <div class="invalid-feedback">
            <?= $validation->getError('deskripsi') ?>
        </div>
    </div>
    <!-- tujuan & titik kumpul -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="text" class="form-control 
            <?= ($validation->hasError('tujuan')) ? 'is-invalid' : '' ?>" 
            name="tujuan" placeholder="Tujuan" value="<?= old('tujuan') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('tujuan') ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control 
            <?= ($validation->hasError('titik_kumpul')) ? 'is-invalid' : '' ?>" 
            name="titik_kumpul" placeholder="Titik Kumpul" value="<?= old('titik_kumpul') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('titik_kumpul') ?>
            </div>
        </div>
    </div>
    <!-- tanggal & jam -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control 
            <?= ($validation->hasError('tanggal')) ? 'is-invalid' : '' ?>" 
            id="tanggal" name="tanggal" placeholder="Tanggal">
            <div class="invalid-feedback">
                <?= $validation->getError('tanggal') ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="jam">Jam</label>
            <input type="time" class="form-control 
            <?= ($validation->hasError('jam')) ? 'is-invalid' : '' ?>" 
            id="jam" name="jam" placeholder="Jam">
            <div class="invalid-feedback">
                <?= $validation->getError('jam') ?>
            </div>
        </div>
    </div>
    <!-- biaya & gambar sampul -->
    <div class="form-row">
        <div class="form-group col">
            <input type="number" min="1" step="any" class="form-control 
            <?= ($validation->hasError('biaya')) ? 'is-invalid' : '' ?>" 
            name="biaya" placeholder="Biaya" value="<?= old('biaya') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('biaya') ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="file" class="form-control-file <?= ($validation->hasError('kgimage')) ? 'is-invalid' : '' ?>" 
        name="kgimage">
        <div class="invalid-feedback">
            <?= $validation->getError('kgimage') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-dark cc-main border-light">Buat Kegiatan</button>
</form>

<?php $this->endSection() ?>