<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Beritaku</h1>
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
<h2 class="text-center">COMING SOON</h2>

<?php $this->endSection() ?>