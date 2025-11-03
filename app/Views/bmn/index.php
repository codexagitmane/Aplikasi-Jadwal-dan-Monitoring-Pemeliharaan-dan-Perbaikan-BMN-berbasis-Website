<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-0">Data Barang Milik Negara</h1>
        <p class="text-muted mb-0">Kelola aset BMN secara terstruktur dan mudah.</p>
    </div>
    <a href="<?= site_url('bmn/create'); ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah BMN</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($items)): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada data BMN.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($items as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td>
                            <?php if (! empty($item['image'])): ?>
                                <img src="<?= base_url('uploads/' . $item['image']); ?>" alt="<?= esc($item['name']); ?>" class="rounded" width="64">
                            <?php else: ?>
                                <span class="badge bg-secondary">Tidak ada foto</span>
                            <?php endif; ?>
                        </td>
                        <td class="fw-semibold"><?= esc($item['name']); ?></td>
                        <td><span class="badge bg-dark-subtle text-dark"><?= esc($item['code']); ?></span></td>
                        <td><?= esc($item['category']); ?></td>
                        <td><?= esc($item['location']); ?></td>
                        <td><?= esc($item['condition']); ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= site_url('bmn/edit/' . $item['id']); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                <?= form_open('bmn/delete/' . $item['id'], ['class' => 'delete-form', 'onsubmit' => 'return confirm("Hapus data ini?");']); ?>
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
