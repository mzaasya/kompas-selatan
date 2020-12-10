<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>
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

<form action="Auth/ubahpassAct" method="post">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cupass">Password Lamamu</label>
            <input type="password" id="cupass" name="cupass" class="form-control 
            <?= ($validation->hasError('cupass') ? 'is-invalid' : '') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('cupass') ?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="newpass">Password Baru</label>
            <input type="password" id="newpass" name="newpass" class="form-control 
            <?= ($validation->hasError('newpass') ? 'is-invalid' : '') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('newpass') ?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="repass">Ulangi Password Baru</label>
            <input type="password" id="repass" name="repass" class="form-control 
            <?= ($validation->hasError('repass') ? 'is-invalid' : '') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('repass') ?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <button type="submit" class="btn btn-block btn-dark cc-main border-light">Ubah Password</button>
        </div>
    </div>
</form>

<?php $this->endSection() ?>