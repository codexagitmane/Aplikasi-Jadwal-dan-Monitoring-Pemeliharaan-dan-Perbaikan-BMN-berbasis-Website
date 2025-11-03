<?= $this->extend('layouts/auth'); ?>

<?= $this->section('content'); ?>
<div class="text-center mb-4">
    <h1 class="h4 fw-bold text-primary">Sistem Jadwal & Monitoring BMN</h1>
    <p class="text-muted mb-0">Masuk untuk melanjutkan</p>
</div>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?= esc(session('error')); ?></div>
<?php endif; ?>
<?php if (session()->has('message')): ?>
    <div class="alert alert-success"><?= esc(session('message')); ?></div>
<?php endif; ?>
<?= form_open('login'); ?>
<div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" id="username" value="<?= old('username'); ?>" class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : ''; ?>" placeholder="Masukkan username" required autofocus>
    <?php if (isset($validation) && $validation->hasError('username')): ?>
        <div class="invalid-feedback"><?= esc($validation->getError('username')); ?></div>
    <?php endif; ?>
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : ''; ?>" placeholder="Masukkan password" required>
    <?php if (isset($validation) && $validation->hasError('password')): ?>
        <div class="invalid-feedback"><?= esc($validation->getError('password')); ?></div>
    <?php endif; ?>
</div>
<button type="submit" class="btn btn-primary w-100">Masuk</button>
<?= form_close(); ?>
<?= $this->endSection(); ?>
