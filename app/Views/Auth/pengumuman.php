<?php $this->extend('Layout/template_settings') ?>

<?php $this->section('konten') ?>

<?php use CodeIgniter\I18n\Time; ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pengumuman</h1>
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

<!-- Konten -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pengumumanModal">Buat Pengumuman</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Pengumuman</th>
                        <th>Tanggal</th>
                        <th>Menu</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Pengumuman</th>
                        <th>Tanggal</th>
                        <th>Menu</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($pengumuman as $pgm): ?>
                    <tr>
                        <td><?= $pgm['pesan'] ?></td>
                        <?php $pgdibuat = Time::parse($pgm['created_at'], 'Asia/Jakarta') ?>
                        <td><?= $pgdibuat->toLocalizedString('d MMM, yyyy') ?></td>
                        <td><a href="/hapuspengumuman/<?= $pgm['id'] ?>" class="btn btn-sm btn-danger">Hapus</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal pesan -->
<div class="modal fade" id="pengumumanModal" tabindex="-1" aria-labelledby="pengumumanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form action="<?= base_url('Auth/pengumumanAct') ?>" method="post">
          <div class="form-group">
            <label for="pengumuman" class="col-form-label">Pengumuman</label>
            <textarea class="form-control" id="pengumuman" name="pengumuman"></textarea>
          </div>
          <div class="float-right">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn cc-main text-white">Buat Pengumuman</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $this->endSection() ?>