<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<?php 
use CodeIgniter\I18n\Time;
$this->ModelUser = new \App\Models\ModelUser();
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Pesan</h1>
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

<!-- Konten -->
<div class="row">
    <div class="col-3 col-md-1 my-auto">
        <?php $pengirim = $this->ModelUser->where('id', $detail['created_by'])->first() ?>
        <?php $penerima = $this->ModelUser->where('id', $detail['created_for'])->first() ?>
        <img class="img-profile rounded-circle" width="65" height="65" 
        src="<?= base_url() ?>/img/user/<?= ($pengirim['image'] !== NULL && $pengirim['image'] !== '') ? $pengirim['image'] : 'default.png' ?>">
    </div>
    <div class="col-9 col-md-6 my-auto">
        <div class="row">
            <div class="col text-dark"><b><?= $pengirim['name'] ?></b></div>
            <div class="w-100"></div>
            <div class="col text-dark"><small>Dikirim ke: <?= ($detail['created_by'] === session()->id) ? $penerima['name'] : 'Saya' ?></small></div>
            <div class="w-100"></div>
            <?php $kapan = Time::parse($detail['created_at'], 'Asia/Jakarta', 'id_ID') ?>
            <div class="col"><small><?= $kapan->toLocalizedString('d MMMM yyyy') ?></small></div>
        </div>
    </div>
</div>
<!-- isi pesan -->
<div class="container p-3">
    <p class="text-dark"><?= $detail['pesan'] ?></p>
</div>

<?php $this->endSection() ?>