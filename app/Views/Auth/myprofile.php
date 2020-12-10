<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<?php use CodeIgniter\I18n\Time; ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
</div>

<!-- success message -->
<?php if(session()->getFlashData('pesan')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- fail message -->
<?php if(session()->getFlashData('pesan-f')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan-f') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- MyProfile Form -->
<form action="Auth/editprofile" method="post" enctype="multipart/form-data">
    <div class="card mb-3">
        <div class="row no-gutters align-items-center">
            <div class="col-md-4">
                <img src="/img/user/<?= ($user['image'] !== NULL && $user['image'] !== '') ? $user['image'] : 'default.png' ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <!-- Form Name -->
                    <div class="form-group row">
                        <label for="editName" class="col-sm-3 col-form-label"><b>Nama</b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control 
                            <?= ($validation->hasError('editName')) ? 'is-invalid' : '' ?>" 
                            id="editName" name="editName" value="<?= $user['name'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('editName') ?>
                            </div>
                        </div>
                    </div>
                    <!-- Form Email -->
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label"><b>Email</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="email" 
                            name="email" value="<?= $user['email'] ?>">
                        </div>
                    </div>
                    <!-- Form Birth -->
                    <div class="form-group row">
                        <label for="editBirth" class="col-sm-3 col-form-label"><b>Tanggal Lahir</b></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" 
                            id="editBirth" name="editBirth" value="<?= $user['birth'] ?>">
                        </div>
                    </div>
                    <!-- Form Address -->
                    <div class="form-group row">
                        <label for="editAddress" class="col-sm-3 col-form-label"><b>Alamat</b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control 
                            <?= ($validation->hasError('editAddress')) ? 'is-invalid' : '' ?>" 
                            id="editAddress" name="editAddress" value="<?= $user['address'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('editAddress') ?>
                            </div>
                        </div>
                    </div>
                    <!-- Form Phone -->
                    <div class="form-group row">
                        <label for="editPhone" class="col-sm-3 col-form-label"><b>No. HP</b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control 
                            <?= ($validation->hasError('editPhone')) ? 'is-invalid' : '' ?>" 
                            id="editPhone" name="editPhone" value="<?= $user['phone'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('editPhone') ?>
                            </div>
                        </div>
                    </div>
                    <!-- Form Image -->
                    <div class="form-group row">
                        <label for="editImage" class="col-sm-3 col-form-label"><b>Gambar Profil</b></label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file" id="editImage" name="editImage" aria-describedby="editImage">
                            <small id="editImage" class="form-text text-muted">Max 5 MB dengan format PNG/JPG/SVG/WeBP</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-dark cc-main">Edit Data</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->endSection() ?>