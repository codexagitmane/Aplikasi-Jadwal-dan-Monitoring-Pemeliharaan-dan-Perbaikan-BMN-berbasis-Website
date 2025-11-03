<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="mb-4">
    <h1 class="h4 mb-0">Tanda Tangan Permohonan</h1>
    <p class="text-muted">Berikan persetujuan Anda untuk permohonan berikut.</p>
</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="fw-bold"><?= esc($item['title']); ?></h5>
        <p class="text-muted mb-4">BMN: <?= esc($item['bmn_name']); ?> | Tanggal: <?= date('d M Y', strtotime($item['requested_date'])); ?></p>
        <?php if (isset($validation) && $validation->hasError('signature')): ?>
            <div class="alert alert-danger"><?= esc($validation->getError('signature')); ?></div>
        <?php endif; ?>
        <?= form_open('repair-requests/sign/' . $item['id']); ?>
        <div class="mb-3">
            <label class="form-label">Tanda Tangan Digital</label>
            <textarea name="signature" class="form-control" rows="3" placeholder="Tuliskan nama lengkap atau catatan persetujuan" required><?= old('signature'); ?></textarea>
        </div>
        <div class="d-flex justify-content-between">
            <a href="<?= site_url('repair-requests/detail/' . $item['id']); ?>" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-primary">Kirim Tanda Tangan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->endSection(); ?>
