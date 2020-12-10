<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kirim Pesan</h1>
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

<!-- Flash message failed -->
<?php if(session()->getFlashData('pesan-f')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('pesan-f') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<form action="<?= base_url('Auth/kirimpesanAct') ?>" method="post">
  <div class="form-row">
    <div class="form-group col-lg-7">
      <label for="penerima">Kirim ke</label>
      <select name="penerima" id="penerima" class="form-control">
        <option value="" selected></option>
        <?php foreach($alluser as $all): ?>
        <option value="<?= $all['name'] ?>"><?= $all['name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group col-lg-7">
        <label for="pesan">Pesan</label>
        <textarea class="form-control" name="pesan" id="pesan" cols="30" rows="5"></textarea>
    </div>
    <button type="submit" class="btn btn-block cc-main text-white col-lg-7">Kirim Pesan</button>
  </div>
</form>

<?php $this->endSection() ?>