<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="mb-4">
    <h1 class="h4 mb-0"><?= esc($pageTitle); ?></h1>
    <p class="text-muted">Kelola informasi akun pengguna.</p>
</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <?= form_open(isset($user) ? 'users/edit/' . $user['id'] : 'users/create'); ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="<?= old('name', $user['name'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= old('email', $user['email'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= old('username', $user['username'] ?? ''); ?>" <?= isset($user) ? 'readonly' : 'required'; ?>>
            </div>
            <div class="col-md-6">
                <label class="form-label">Peran</label>
                <select name="role" class="form-select" required>
                    <?php $roles = ['admin' => 'Admin', 'pengelola_bmn' => 'Pengelola BMN', 'kasubag_tu' => 'Kasubag TU', 'pegawai' => 'Pegawai']; ?>
                    <?php foreach ($roles as $value => $label): ?>
                        <option value="<?= $value; ?>" <?= old('role', $user['role'] ?? '') === $value ? 'selected' : ''; ?>><?= $label; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" <?= isset($user) ? '' : 'required'; ?> placeholder="<?= isset($user) ? 'Biarkan kosong jika tidak diubah' : 'Masukkan password'; ?>">
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-between">
            <a href="<?= site_url('users'); ?>" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->endSection(); ?>
