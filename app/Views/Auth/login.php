<?php $this->extend('Layout/template_login') ?>

<?php $this->section('konten') ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">

                <?php if(session()->getFlashData('pesan-s')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('pesan-s') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashData('pesan')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('pesan') ?>
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
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                                </div>
                                <form action="<?= base_url('Auth/loginAct') ?>" method="post" class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user 
                                        <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                        id="email" name="email" placeholder="Alamat Email" value="<?= old('email') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user 
                                        <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                        id="password" name="password" placeholder="Kata Sandi">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-light text-white cc-main btn-user btn-block">
                                        Masuk
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small tt-main" href="/forgot">Lupa Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small tt-main" href="/daftar">Gabung Menjadi Anggota!</a>
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