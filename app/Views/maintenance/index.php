<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-0">Jadwal Pemeliharaan & Perbaikan</h1>
        <p class="text-muted mb-0">Pantau seluruh jadwal pemeliharaan dan perbaikan BMN.</p>
    </div>
    <a href="<?= site_url('maintenance/create'); ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Jadwal Baru</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>BMN</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($items)): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada jadwal pemeliharaan.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($items as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td class="fw-semibold"><?= esc($item['title']); ?></td>
                        <td><?= esc($item['bmn_name'] ?? '-'); ?></td>
                        <td><?= date('d M Y', strtotime($item['scheduled_date'])); ?></td>
                        <td><span class="badge bg-<?= $item['type'] === 'maintenance' ? 'info' : 'warning'; ?> text-uppercase"><?= esc($item['type']); ?></span></td>
                        <td><span class="badge bg-success-subtle text-success"><?= esc(ucwords($item['status'])); ?></span></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= site_url('maintenance/edit/' . $item['id']); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                <?= form_open('maintenance/delete/' . $item['id'], ['class' => 'delete-form', 'onsubmit' => 'return confirm("Hapus jadwal ini?");']); ?>
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
