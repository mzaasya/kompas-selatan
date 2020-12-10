<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<?php 
use CodeIgniter\I18n\Time;
$this->ModelUser = new \App\Models\ModelUser();
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pesan Masuk</h1>
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

<?php if(session()->getFlashData('pesan-f')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan-f') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="list-group">
<?php foreach($pesan as $ps): ?>
    <?php $usr = $this->ModelUser->where('id', $ps['created_by'])->first() ?>
    <a href="/detailpesan/<?= $ps['id'] ?>" class="list-group-item list-group-item-action <?= ($ps['status'] == 0) ? 'font-weight-bold text-dark' : 'bg-light' ?>">
        <div class="row font-nunito">
            <div class="col-md-3 my-auto">
                <?= $usr['name'] ?>
            </div>
            <div class="col-md-8 my-auto text-truncate">
                <small><?= $ps['pesan'] ?></small>
            </div>
            <div class="col-md-1 my-auto text-right">
                <?php $wkt = Time::parse($ps['created_at'], 'Asia/Jakarta', 'id_ID') ?>
                <small><?= $wkt->toLocalizedString('d MMM') ?></small>
            </div>
        </div>
    </a>
<?php endforeach; ?>
</div>
<br>
<?= $pager->links() ?>

<!-- Modal detail pesan -->
<div class="modal fade" id="dpModal" tabindex="-1" aria-labelledby="dpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dpModalLabel"></h5>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>