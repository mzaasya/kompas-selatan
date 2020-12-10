<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kegiatan</h1>
</div>

<!-- Flash message success -->
<?php if(session()->getFlashData('pesan-s')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan-s') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

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
<form action="/Kegiatan/editkegiatanAct/<?= $kg['id'] ?>" method="post" enctype="multipart/form-data">
    <!-- Judul -->
    <div class="form-group">
        <input type="text" class="form-control 
        <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" 
        name="judul" placeholder="Judul Kegiatan" value="<?= $kg['judul'] ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('judul') ?>
        </div>
    </div>
    <!-- deskripsi -->
    <div class="form-group">
        <textarea name="deskripsi" id="deskripsi" class="form-control 
        <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ?>" 
        rows="5" placeholder="Deskripsi"><?= $kg['deskripsi'] ?></textarea>
        <div class="invalid-feedback">
            <?= $validation->getError('deskripsi') ?>
        </div>
    </div>
    <!-- tujuan & titik kumpul -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="text" class="form-control 
            <?= ($validation->hasError('tujuan')) ? 'is-invalid' : '' ?>" 
            name="tujuan" placeholder="Tujuan" value="<?= $kg['tujuan'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('tujuan') ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control 
            <?= ($validation->hasError('titik_kumpul')) ? 'is-invalid' : '' ?>" 
            name="titik_kumpul" placeholder="Titik Kumpul" value="<?= $kg['titik_kumpul'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('titik_kumpul') ?>
            </div>
        </div>
    </div>
    <!-- tanggal & jam -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="date" class="form-control 
            <?= ($validation->hasError('tanggal')) ? 'is-invalid' : '' ?>" 
            name="tanggal" placeholder="Tanggal" value="<?= $kg['tanggal'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('tanggal') ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <input type="time" class="form-control 
            <?= ($validation->hasError('jam')) ? 'is-invalid' : '' ?>" 
            name="jam" placeholder="Jam" value="<?= $kg['jam'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('jam') ?>
            </div>
        </div>
    </div>
    <!-- biaya -->
    <div class="form-group">
        <input type="number" min="1" step="any" class="form-control 
        <?= ($validation->hasError('biaya')) ? 'is-invalid' : '' ?>" 
        name="biaya" placeholder="Biaya" value="<?= $kg['biaya'] ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('biaya') ?>
        </div>
    </div>
    <!-- gambar 1 & 2 -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="img1">Gambar 1 (sampul)</label>
            <input type="file" class="form-control-file" id="img1" name="kgimage1" aria-describedby="img1Help">
            <small id="img1Help" class="form-text text-success"><?= $kg['gambar'] ?></small>
        </div>
        <div class="form-group col-md-6">
            <label for="img2">Gambar 2</label>
            <input type="file" class="form-control-file" id="img2" name="kgimage2" aria-describedby="img2Help">
            <small id="img2Help" class="form-text text-success"><?= $kg['gambar1'] ?></small>
        </div>
    </div>
    <!-- gambar 3 & 4 -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="img3">Gambar 3</label>
            <input type="file" class="form-control-file" id="img3" name="kgimage3" aria-describedby="img3Help">
            <small id="img3Help" class="form-text text-success"><?= $kg['gambar2'] ?></small>
        </div>
        <div class="form-group col-md-6">
            <label for="img4">Gambar 4</label>
            <input type="file" class="form-control-file" id="img4" name="kgimage4" aria-describedby="img4Help">
            <small id="img4Help" class="form-text text-success"><?= $kg['gambar3'] ?></small>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-dark cc-main border-light">Edit Kegiatan</button>
</form>

<?php $this->endSection() ?>