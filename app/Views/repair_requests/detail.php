<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-0">Detail Permohonan</h1>
        <p class="text-muted mb-0">Informasi lengkap permohonan perbaikan BMN.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= site_url('repair-requests/print/' . $item['id']); ?>" class="btn btn-success" target="_blank"><i class="bi bi-printer"></i> Cetak</a>
        <?php if (user_has_role('pengelola_bmn', 'kasubag_tu', 'pegawai') && empty($hasSigned)): ?>
            <a href="<?= site_url('repair-requests/sign/' . $item['id']); ?>" class="btn btn-primary"><i class="bi bi-pen"></i> Tanda Tangani</a>
        <?php endif; ?>
        <a href="<?= site_url('repair-requests'); ?>" class="btn btn-light">Kembali</a>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold"><?= esc($item['title']); ?></h5>
                <div class="mb-3">
                    <span class="badge bg-<?= $item['priority'] === 'tinggi' ? 'danger' : ($item['priority'] === 'sedang' ? 'warning' : 'success'); ?> text-uppercase">Prioritas <?= esc($item['priority']); ?></span>
                    <span class="badge bg-info-subtle text-info">Status <?= esc(ucwords(str_replace('_', ' ', $item['status']))); ?></span>
                </div>
                <p class="text-muted">Tanggal Permohonan: <strong><?= date('d M Y', strtotime($item['requested_date'])); ?></strong></p>
                <p class="text-muted">BMN: <strong><?= esc($item['bmn_name']); ?></strong></p>
                <p class="text-muted">Pemohon: <strong><?= esc($item['requester_name']); ?></strong></p>
                <h6 class="fw-semibold mt-4">Deskripsi Permohonan</h6>
                <p><?= nl2br(esc($item['description'])); ?></p>
                <?php if (! empty($item['notes'])): ?>
                    <h6 class="fw-semibold mt-4">Catatan</h6>
                    <p><?= nl2br(esc($item['notes'])); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h6 class="mb-0">Tanda Tangan</h6>
            </div>
            <div class="list-group list-group-flush">
                <?php if (empty($signatures)): ?>
                    <div class="list-group-item text-center text-muted">Belum ada tanda tangan.</div>
                <?php endif; ?>
                <?php foreach ($signatures as $signature): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold text-capitalize"><?= esc(str_replace('_', ' ', $signature['role'])); ?></span>
                            <small class="text-muted"><?= date('d M Y H:i', strtotime($signature['created_at'])); ?></small>
                        </div>
                        <p class="mb-1 text-muted"><?= esc($signature['signer_name'] ?? ''); ?></p>
                        <p class="mb-0 fst-italic">"<?= esc($signature['signature']); ?>"</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
