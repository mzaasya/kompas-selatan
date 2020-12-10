<?php $this->extend('Layout/template_login') ?>

<?php $this->section('konten') ?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <!-- flash data success -->
                <?php if(session()->getFlashData('pesan')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('pesan') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
                <!-- flash data failed -->
                <?php if(session()->getFlashData('pesan-f')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('pesan-f') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>

                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-4">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Yuk isi Datanya</h1>
                                </div>
                                <form action="<?= base_url('Auth/daftarAct') ?>" method="post" class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user 
                                        <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" 
                                        id="name" name="name" placeholder="Nama Lengkap" value="<?= old('name') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('name') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user 
                                        <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                                        id="email" name="email" placeholder="Alamat Email" value="<?= old('email') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user 
                                            <?= ($validation->hasError('pass1')) ? 'is-invalid' : '' ?>" 
                                            id="pass1" name="pass1" placeholder="Kata Sandi" value="<?= old('pass1') ?>">
                                            <div class="invalid-feedback">
                                            <?= $validation->getError('pass1') ?>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user 
                                            <?= ($validation->hasError('pass2')) ? 'is-invalid' : '' ?>" 
                                            id="pass2" name="pass2" placeholder="Ulangi Kata Sandi">
                                            <div class="invalid-feedback">
                                            <?= $validation->getError('pass2') ?>
                                        </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-light text-white cc-main btn-user btn-block">
                                        Daftar
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small tt-main" href="/forgot">Lupa Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small tt-main" href="/login">Sudah jadi anggota? Login!</a>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <a class="small tt-main" href="/">Kembali ke Beranda</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php $this->endSection() ?>