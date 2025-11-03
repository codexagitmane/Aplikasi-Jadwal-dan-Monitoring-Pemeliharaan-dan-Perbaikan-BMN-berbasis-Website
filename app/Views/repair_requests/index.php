<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-0">Permohonan Perbaikan BMN</h1>
        <p class="text-muted mb-0">Kelola permohonan perbaikan dari seluruh pegawai.</p>
    </div>
    <a href="<?= site_url('repair-requests/create'); ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Permohonan Baru</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>BMN</th>
                    <th>Pemohon</th>
                    <th>Tanggal</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($items)): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada permohonan perbaikan.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($items as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td class="fw-semibold"><?= esc($item['title']); ?></td>
                        <td><?= esc($item['bmn_name']); ?></td>
                        <td><?= esc($item['requester_name']); ?></td>
                        <td><?= date('d M Y', strtotime($item['requested_date'])); ?></td>
                        <td><span class="badge bg-<?= $item['priority'] === 'tinggi' ? 'danger' : ($item['priority'] === 'sedang' ? 'warning' : 'success'); ?> text-uppercase"><?= esc($item['priority']); ?></span></td>
                        <td><span class="badge bg-info-subtle text-info"><?= esc(ucwords(str_replace('_', ' ', $item['status']))); ?></span></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= site_url('repair-requests/detail/' . $item['id']); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                <a href="<?= site_url('repair-requests/edit/' . $item['id']); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="<?= site_url('repair-requests/print/' . $item['id']); ?>" target="_blank" class="btn btn-sm btn-outline-success"><i class="bi bi-printer"></i></a>
                                <?= form_open('repair-requests/delete/' . $item['id'], ['class' => 'delete-form', 'onsubmit' => 'return confirm("Hapus permohonan ini?");']); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                <?= form_close(); ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
