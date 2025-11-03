<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-0">Manajemen Pengguna</h1>
        <p class="text-muted mb-0">Kelola akses seluruh peran dalam sistem.</p>
    </div>
    <a href="<?= site_url('users/create'); ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Pengguna Baru</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada pengguna terdaftar.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $index => $user): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td class="fw-semibold"><?= esc($user['name']); ?></td>
                        <td><?= esc($user['username']); ?></td>
                        <td><?= esc($user['email']); ?></td>
                        <td><span class="badge bg-primary-subtle text-primary text-capitalize"><?= esc(str_replace('_', ' ', $user['role'])); ?></span></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= site_url('users/edit/' . $user['id']); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                <?= form_open('users/delete/' . $user['id'], ['class' => 'delete-form', 'onsubmit' => 'return confirm("Hapus pengguna ini?");']); ?>
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
