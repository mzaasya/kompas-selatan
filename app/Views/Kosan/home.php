<?php $this->extend('Layout/template') ?>

<?php $this->section('konten') ?>

<div class="d-none d-lg-block p-5"></div>

<!-- Flash message success -->
<?php if(session()->getFlashData('pesan')): ?>
    <div class="d-lg-none p-5"></div>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- Flash message failed -->
<?php if(session()->getFlashData('pesan-f')): ?>
    <div class="d-lg-none p-5"></div>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan-f') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="container p-5">
    <div class="row">
        <div class="col-lg-6 align-self-center my-3">
            <img src="<?= base_url('img/bgraung.png') ?>" width="400" class="img-fluid">
        </div>
        <div class="col-lg-6 align-self-center my-3">
            <h3 class="font-comfort text-dark">MARI BERTUALANG SELAGI MASIH MUDA JADI TUA PUNYA CERITA</h3>
            <p class="font-300 font-roboto">Ayo gabung bersama keluarga kecil kami dimana hobi menyatukan kita dan perjalanan mengenalkan kita pada satu sama lain</p>
            <a href="/daftar" class="btn btn-outline-light text-white cc-main px-4 py-2">GABUNG</a>
        </div>
    </div>
</div>

<hr>

<div class="container p-5">
    <h3 class="text-center font-comfort font-300 mb-5">KENAPA HARUS <b>KOMPAS SELATAN</b> ?</h3>
    <div class="row row-cols-1 row-cols-md-3 text-center font-nunito font-300">
        <div class="col mb-4">
            <p><i class="fas fa-5x fa-users" style="color:#835331;"></i></p>
            <h3 class="font-comfort font-300">Toleransi</h3>
            <p>Kami menghargai perbedaan karena setiap anggota punya karakter yang berbeda dan itu yang membuat <b>KOMPAS SELATAN</b> lebih berwarna.</p>
        </div>
        <div class="col mb-4">
            <p><i class="fas fa-5x fa-donate" style="color:#835331;"></i></p>
            <h3 class="font-comfort font-300">Tanpa Iuran</h3>
            <p>Kami tidak memungut iuran, jika ada keperluan bersama kita patungan. Belum bisa ikut patungan? Kamu peduli pun sudah terhitung patungan.</p>
        </div>
        <div class="col mb-4">
            <p><i class="fas fa-5x fa-hands-helping" style="color:#835331;"></i></p>
            <h3 class="font-comfort font-300">Gabung Aja Dulu</h3>
            <p>Gabung dulu kenalan nanti. Tidak harus langsung mengenalkan diri jika masih malu, jika sudah siap tinggal ikut kita aja di menu kegiatan.</p>
        </div>
    </div>
</div>

<?php $this->endSection() ?>